<section class="mb-5 lg:mb-10">
    <div class="container max-w-container-medium">
        <x-video
            :videoUrl="$block->video_url"
            :videoUrlParameters="$block->paramString()"
        />
    </div>
</section>
