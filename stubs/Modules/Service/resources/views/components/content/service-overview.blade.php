<section {{ $attributes }}>
    <div class="container max-w-container">
        <ul class="list-none pl-0 grid md:grid-cols-2 gap-5">
            @foreach($services as $service)
                <li>
                    <x-cards.service :service="$service"/>
                </li>
            @endforeach
        </ul>

        <div class="py-10 lg:py-16">
            {{ $services->links('components.pagination.simple') }}
        </div>
    </div>
</section>
