<section {{ $attributes }}>
    <div class="container max-w-container">
        <ul class="list-none pl-0 grid xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($employees as $employee)
                <li>
                    <x-cards.employee :employee="$employee"/>
                </li>
            @endforeach
        </ul>

        <div class="py-10 lg:py-16">
            {{ $employees->links('components.pagination.simple') }}
        </div>
    </div>
</section>
