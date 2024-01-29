<section>
    <div class="container max-w-container">
        <ul class="list-none pl-0 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($newsItems as $newsItem)
                <li>
                    <x-cards.news :newsItem="$newsItem"/>
                </li>
            @endforeach
        </ul>

        <div class="py-10 lg:py-16">
            {{ $newsItems->links('components.pagination.simple') }}
        </div>
    </div>
</section>
