<x-layouts.app>
    @section('breadcrumbs')
        <x-content.breadcrumbs :backLink="url('/')" :backTitle="__('Back to home')">
            <x-content.breadcrumb :title="__('Dev elements')"/>
        </x-content.breadcrumbs>
    @endsection

    <x-hero.hero
        title="Hero component"
        text="Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus."
        img="https://motivo.nl/storage/files/shares/Over-ons/Motivo-zwolle-bekijk-ons-team.jpg"
        alt="Beschrijving van de afbeelding"
        primaryBtnText="Primaire cta"
        primaryBtnLink="/"
        secondaryBtnText="Secundaire cta"
        secondaryBtnLink="/"
        class="mt-5"
    />

    <section class="py-5 mt-5 lg:py-8 lg:mt-8">
        <div class="container max-w-container">
            <h2 class="heading-3">
                Kleur variabelen
            </h2>

            <div class="grid grid-cols-3 gap-5 mt-8">
                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-primary"></div>
                    <p>primary</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-primary-dark"></div>
                    <p>primary-dark</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-primary-light"></div>
                    <p>primary-light</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-secondary"></div>
                    <p>secondary</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-secondary-dark"></div>
                    <p>secondary-dark</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-secondary-light"></div>
                    <p>secondary-light</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-tertiary"></div>
                    <p>tertiary</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-tertiary-dark"></div>
                    <p>tertiary-dark</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-tertiary-light"></div>
                    <p>tertiary-light</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-default-background"></div>
                    <p>default-background<br/>
                        <span class="text-sm text-slate-500">
                            standaard achtergrond kleur
                        </span>
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-default-color"></div>
                    <p>default-color<br/>
                        <span class="text-sm text-slate-500">
                            standaard tekstkleur
                        </span>
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-default-accent"></div>
                    <p>default-accent<br/>
                        <span class="text-sm text-slate-500">
                            standaard accent kleur
                        </span>
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-danger"></div>
                    <p>danger</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-warning"></div>
                    <p>warning</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="h-12 w-auto min-w-12 bg-success"></div>
                    <p>success</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 mt-5 lg:py-8 lg:mt-8">
        <div class="container max-w-container">
            <h2 class="heading-3">
                Buttons en links
            </h2>

            <div class="flex flex-wrap gap-2 mt-8">
                <x-button
                    href="/"
                    class="btn-primary"
                    title="btn-primary"
                />

                <x-button
                    href="/"
                    class="btn-primary"
                    title="btn-primary arrow-right"
                    icon="arrow-right"
                />

                <x-button
                    href="/"
                    class="btn-primary btn-reverse"
                    title="btn-primary btn-reverse arrow-left"
                    icon="arrow-left"
                />

                <x-button
                    href="/"
                    class="btn-primary"
                    disabled="true"
                    title="disabled"
                    icon="arrow-right"
                />
            </div>

            <div class="flex flex-wrap gap-2 mt-4">
                <x-button
                    href="/"
                    class="btn-secondary"
                    title="btn-secondary"
                />

                <x-button
                    href="/"
                    class="btn-secondary"
                    title="btn-secondary arrow-right"
                    icon="arrow-right"
                />

                <x-button
                    href="/"
                    class="btn-secondary btn-reverse"
                    title="btn-secondary btn-reverse arrow-left"
                    icon="arrow-left"
                />

                <x-button
                    href="/"
                    class="btn-secondary btn-reverse btn-clean"
                    title="btn-clean"
                    icon="arrow-left"
                />

                <x-button
                    href="/"
                    class="btn-secondary"
                    disabled="true"
                    title="disabled"
                    icon="arrow-right"
                />
            </div>

            <div class="flex flex-wrap gap-2 mt-4">
                <x-button-donate />
            </div>

            <div class="mt-8">
                <h3 class="heading-6 font-normal">Button small variant</h3>
                <div class="flex flex-wrap gap-2 mt-4">
                    <x-button
                        href="/"
                        class="btn-primary btn-small"
                        title="btn-primary btn-small"
                        icon="arrow-right"
                    />

                    <x-button
                        href="/"
                        class="btn-secondary btn-reverse btn-small"
                        title="btn-secondary btn-reverse btn-small"
                        icon="arrow-left"
                    />

                    <x-button
                        href="/"
                        class="btn-secondary btn-reverse btn-small btn-clean"
                        title="btn-small btn-clean"
                        icon="arrow-left"
                    />
                </div>
            </div>

            <div class="mt-8">
                <h3 class="heading-6 font-normal">Link varianten</h3>
                <div class="flex flex-wrap gap-y-2 gap-x-5 mt-4 mb-4">
                    <x-link href="/" title="Just a link"/>
                    <x-link href="/" title="External link" target="_blank"/>
                    <x-link href="/" title="Link with icon" icon="chevron-right"/>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 lg:py-8">
        <div class="flex flex-col gap-5 container max-w-container">
            <h2 class="heading-3">
                Cards
            </h2>
            <ul class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 list-none pl-0">
                @for ($i = 0; $i < 3; $i++)
                <li>
                    <x-cards.card
                        title="Component card titel"
                        heading="3"
                        href="/"
                        text="Dit is een voorbeeld tekst"
                        img="https://motivo.nl/storage/files/shares/Over-ons/Motivo-zwolle-bekijk-ons-team.jpg"
                        alt="Beschrijving van de afbeelding"
                        label="Label"
                        date="13 juni 2022"
                    />
                </li>
                @endfor
            </ul>

            <ul class="grid md:grid-cols-2 gap-5 list-none pl-0">
                @for ($i = 0; $i < 2; $i++)
                    <li>
                        <x-cards.card
                            title="Card landscape"
                            heading="3"
                            href="/"
                            text="Gebruik landscape=true"
                            img="https://motivo.nl/storage/files/shares/Over-ons/Motivo-zwolle-bekijk-ons-team.jpg"
                            alt="Beschrijving van de afbeelding"
                            label="Label"
                            date="13 juni 2022"
                            landscape="true"
                        />
                    </li>
                @endfor
            </ul>
        </div>
    </section>
</x-layouts.app>
