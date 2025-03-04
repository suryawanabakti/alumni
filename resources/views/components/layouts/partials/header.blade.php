@if (request()->is('/'))
    <nav class="navbar navbar-expand-md justify-content-between fixed-top">
        <div class="container"><a class="navbar-brand fw-bold d-flex align-items-center" href="/"><img class="me-2"
                    src="/assets/unitama.png" alt="Logo ITH">IKA UNITAMA</a><button class="navbar-toggler border-0"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links" aria-controls="navbar-links"
                aria-label="Toggle navigation"><span class="bi-list fs-2"></span></button>
            <div class="collapse navbar-collapse gap-3 justify-content-end" id="navbar-links">
                @include('components.layouts.partials.links')
            </div>
        </div>
    </nav>
@else
    <nav class="navbar navbar-expand-md justify-content-between fixed-top bg-body-secondary">
        <div class="container"><a class="navbar-brand fw-bold d-flex align-items-center" href="/"><img
                    class="me-2" src="/assets/unitama.png" alt="Logo ITH">IKA UNITAMA</a><button
                class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links"
                aria-controls="navbar-links" aria-label="Toggle navigation"><span class="bi-list fs-2"></span></button>
            <div class="collapse navbar-collapse gap-3 justify-content-end" id="navbar-links">
                @include('components.layouts.partials.links')

            </div>
        </div>
    </nav>
@endif
