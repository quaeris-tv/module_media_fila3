<?php

declare(strict_types=1);
/**
 * ---.
 */

namespace Modules\Media\Http\Livewire\VideoEditor;

header('Accept-Ranges: bytes');

use Illuminate\Contracts\Support\Renderable;
// use FFMpeg\Coordinate\Dimension;
// use FFMpeg\Format\Video\X264;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Media\Jobs\ExportClipJob;
use Modules\Media\Jobs\ExportFrameJob;
use Modules\Media\Models\SpatieImage;
use Modules\Mediamonitor\Models\Media;
use Modules\Mediamonitor\Services\MediaService;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\MediaLibrary\HasMedia;

/**
 * Undocumented class.
 */
class Toolbar extends Component {
    public Media $model;
    // public HasMedia $model;
    public string $type = 'bar1';
    public string $model_class;
    public int $model_id;

    public array $attrs = [];
    public float $currentTime = 0;
    public float $rangeFrom = 0;
    public float $rangeTo = 0;

    public array $form_data = [];

    protected $listeners = [
        'setVideoCurrentTime' => 'setCurrentTime',
        'updateSliderValues' => 'updateSliderValues',
        'setSliderValues' => 'setSliderValues',
        'refreshComponent' => '$refresh', // https://benborgers.com/posts/livewire-refresh-other-component
        'updateDataFromModal' => 'updateDataFromModal',
    ];

    // $this->emitTo('component-to-refresh', 'refreshComponent')

    /**
     * @return void
     */
    public function mount(string $id, string $model_class, int $model_id) {
        $this->attrs['id'] = $id;
        $this->model_class = $model_class;
        $this->model_id = $model_id;
    }

    /**
     * Undocumented function.
     */
    public function getModelProperty(): HasMedia {
        return app($this->model_class)->find($this->model_id);
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'media::livewire.video-editor.toolbar.'.$this->type;
        $view_params = [
            'view' => $view,
            'snaps' => $this->model->getMedia('snaps'),
            'clips' => $this->model->getMedia('clips'),
        ];

        return view()->make($view, $view_params);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function setPoster(int $id) {
        /**
         * @var SpatieImage[]
         */
        $snaps = $this->model->getMedia('snaps', ['isPoster' => true]);
        foreach ($snaps as $snap) {
            $snap->setCustomProperty('isPoster', false);
            $snap->save();
        }

        $snaps = $this->model->getMedia('snaps');
        /**
         * @var SpatieImage
         */
        $snap = $snaps->firstWhere('id', $id);
        $snap->setCustomProperty('isPoster', true);
        $snap->save();

        $this->model->poster_path = $snap->getUrl();
        $this->model->save();
    }

    public function deleteSnap(int $id) {
        /**
         * @var SpatieImage
         */
        $snap = $this->model->getMedia('snaps')->firstWhere('id', $id);
        $snap->delete();
        $this->model->refresh();
        // $this->dispatchBrowserEvent('staff-deleted');
        // session()->flash('success', 'Staff Deleted Successfully 😃!');
    }

    public function deleteClip(int $id) {
        /**
         * @var SpatieImage
         */
        $media = $this->model->getMedia('clips')->firstWhere('id', $id);
        $media->delete();
        $this->model->refresh();
        // $this->dispatchBrowserEvent('staff-deleted');
        // session()->flash('success', 'Staff Deleted Successfully 😃!');
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function setCurrentTime(float $time) {
        $this->currentTime = $time;
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function updateSliderValues(array $values) {
        $this->rangeFrom = min($values) * 1.0;
        $this->rangeTo = max($values) * 1.0;
    }

    public function setSliderValues(float $from, float $to) {
        $this->rangeFrom = $from;
        $this->rangeTo = $to;
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function exportFrame() {
        /*
        MediaService::make()
            ->setModel($this->model)
            ->setCurrentTime($this->currentTime)
            ->exportFrame();
        //*/
        ExportFrameJob::dispatch($this->model_class, $this->model_id, $this->currentTime);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function exportClip() {
        /*
        MediaService::make()
            ->setModel($this->model)
            ->setRange($this->rangeFrom,$this->rangeTo)
            ->exportClip();
        //*/
        ExportClipJob::dispatch($this->model_class, $this->model_id, $this->rangeFrom, $this->rangeTo);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function chooseClipTag(int $clip_id) {
        $clip = $this->model->getMedia('clips')->firstWhere('id', $clip_id);
        $data = [];
        $user = Auth::user();
        // --------------------- FARE CON PROFILE
        $tag_type = 'customers';

        $user->attachTags(['tag 1', 'tag 2', 'tag 3', 'tag 4', 'tag 5'], $tag_type);
        $user_tags = $user->tagsWithType($tag_type);
        $clip_tags = $clip->tagsWithType($tag_type)->keyBy('id');
        $data = [];
        $data['clip_id'] = $clip_id;
        $data['tags'] = $user_tags->map(function ($item) use ($clip_tags) {
            return [
                'id' => $item->id,
                'label' => $item->name,
                'active' => is_object($clip_tags->get($item->id)),
            ];
        });
        // dddx([$user_tags, $clip_tags, $data]);

        // $data = [];
        $this->emit('showModal', 'chooseClipTag', $data);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function updateDataFromModal(string $id, array $data) {
        // dddx($id);//chooseClipTag
        // if($id!=='chooseClipTag'){
        //    return ;
        // }
        $tag_type = 'customers';
        $clip_id = $data['clip_id'];
        $tags = $data['tags'];
        $clip = $this->model->getMedia('clips')->firstWhere('id', $clip_id);
        $tags = collect($tags)->filter(
            function ($item) {
                return $item['active'];
            }
        )->pluck('label')
        ->all();
        $clip->syncTagsWithType($tags, $tag_type);
    }

    /**
     * Undocumented function.
     */
    public function clickMerge(): void {
        $ids = $this->form_data['clip_merge'] ?? [];
        $ids = array_keys($ids);
        // dddx([$ids,$this->form_data]);
        $data = [];
        $data['model_class'] = SpatieImage::class;
        $data['ids'] = $ids;
        $this->emit('showModal', 'mergeClips', $data);
    }
}
