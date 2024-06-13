<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Media\Models\CuratorMedia;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class() extends XotBaseMigration {
    protected ?string $model_class = CuratorMedia::class;

    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->id();
                $table->string('disk')->default('public');
                $table->string('directory')->default('media');
                $table->string('visibility')->default('public');
                $table->string('name');
                $table->string('path');
                $table->unsignedInteger('width')->nullable();
                $table->unsignedInteger('height')->nullable();
                $table->unsignedInteger('size')->nullable();
                $table->string('type')->default('image');
                $table->string('ext');
                $table->string('alt')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->text('caption')->nullable();
                $table->text('exif')->nullable();
                $table->longText('curations')->nullable();
                // $table->timestamps();
            });
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $this->updateTimestamps($table, true);
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(app(config('curator.model'))->getTable());
    }
};
