@extends('frontend.layouts.master')

@section('main-content')
    <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Blog</h1>
              <p class="mb-0">
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Blog</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->


    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
        @if ($posts->count() == 0)
            <P>No post is available</P>
        @else
            @foreach ($posts as $post)
            <div class="col-lg-4">
            <article>

              <div class="post-img">
                <img src="{{ asset('uploads/posts/'.$post->featured_photo) }}" alt="" class="img-fluid">
              </div>

              <p class="post-category">{{ $post->tags }}</p>

              <h2 class="title">
                <a href="{{  route('blog_details',$post->slug) }}">{{ $post->title }}</a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="{{ asset('uploads/admin/'.$admin->photo) }}" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">{{ $admin->name }}</p>
                  <p class="post-date">
                    <time>{{ $post->created_at->format('F j, Y') }}</time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->
            @endforeach
        @endif



        </div>
      </div>

    </section><!-- /Blog Posts Section -->

    <!-- Pagination 2 Section -->
    <section id="pagination-2" class="pagination-2 section">

      <div class="container">
        <nav class="mt-5" data-aos="fade-up" data-aos-delay="300">
              <ul class="pagination justify-content-center">
                <style>
                    p.small.text-muted {
                            display: none !important;
                    }
                </style>

                {{ $posts->links('pagination::bootstrap-4') }}

              </ul>
            </nav>
      </div>

    </section><!-- /Pagination 2 Section -->

  </main>

@endsection
