    <!-- About banner starts -->
    <section class="about-banner {{ Request::is('recipes/cooking*') ? 'd-none' : ''}}h">
        <div class="container text-center">
            <h1 class="banner-title">{{ $title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- About banner ends -->