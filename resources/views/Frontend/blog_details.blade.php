@extends('frontend.layouts.master')

@section('main-content')
    <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Blog Details</h1>
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
            <li class="current">Blog Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Blog Details Section -->
    <section id="blog-details" class="blog-details section">
      <div class="container" data-aos="fade-up">

        <article class="article">

          <div class="hero-img" data-aos="zoom-in">
            <img src="{{ asset('uploads/posts/'.$post->featured_photo) }}" alt="Featured blog image" class="img-fluid" loading="lazy">
            <div class="meta-overlay">
              <div class="meta-categories">
                <a href="#" class="category">{{ $post->tags }}</a>
                <span class="divider">•</span>
                <span class="reading-time"><i class="bi bi-eye"></i> {{ $post->view_count }} views read</span>
              </div>
            </div>
          </div>

          <div class="article-content" data-aos="fade-up" data-aos-delay="100">
            <div class="content-header">
              <h1 class="title">{{ $post->title }}</h1>

              <div class="author-info">
                <div class="author-details">
                  <img src="{{ asset('uploads/admin/'.$admin->photo) }}" alt="Author" class="author-img">
                  <div class="info">
                    <h4>{{ $admin->name }}</h4>
                    <span class="role">CEO of Real Estate Website</span>
                  </div>
                </div>
                <div class="post-meta">
                  <span class="date"><i class="bi bi-calendar3"></i> {{ $post->created_at->format('F j, Y') }}</span>
                  {{-- <span class="divider">•</span>
                  <span class="comments"><i class="bi bi-chat-text"></i> 18 Comments</span> --}}
                </div>
              </div>
            </div>

            <div class="content">
              <p class="lead">
                {{ $post->summary }}
              </p>

              <p>
                {{ $post->description }}
              </p>

              <div class="content-image right-aligned">
                <img src="{{ asset('uploads/posts/'.$post->photo) }}" class="img-fluid" alt="Modern web development tools" loading="lazy">
                <figcaption>{{ $post->title }}</figcaption>
              </div>

              <h2>{{ $post->sub_title }}</h2>
              <p>
                {{ $post->sub_summary }}
              </p>
              <ul>
                {{ $post->sub_li }}
              </ul>

              <div class="highlight-box">
                <h3>Key Trends in {{ date('Y') }}</h3>
                <ul class="trend-list">
                  <li>
                    <i class="bi bi-lightning-charge"></i>
                    <span>Edge Computing and Serverless Architecture</span>
                  </li>
                  <li>
                    <i class="bi bi-shield-check"></i>
                    <span>Enhanced Security Measures</span>
                  </li>
                  <li>
                    <i class="bi bi-phone"></i>
                    <span>Progressive Web Apps (PWAs)</span>
                  </li>
                </ul>
              </div>

              <h2>Performance Optimization</h2>
              <p>
                Performance remains a critical factor in web development, with an increasing focus on Core Web Vitals and user experience metrics. Modern applications must be optimized for both speed and efficiency.
              </p>

              <blockquote>
                <p>
                  "The future of web development lies not just in writing code, but in creating seamless, accessible, and performant experiences that work for everyone, everywhere."
                </p>
                <cite>Emily Thompson, Web Performance Architect</cite>
              </blockquote>

              <div class="content-grid">
                <div class="row g-4">
                  <div class="col-md-6">
                    <div class="info-card">
                      <i class="bi bi-speedometer2"></i>
                      <h4>Performance Metrics</h4>
                      <p>Focus on Core Web Vitals and user-centric performance metrics for better search rankings and user experience.</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-card">
                      <i class="bi bi-universal-access"></i>
                      <h4>Accessibility</h4>
                      <p>Implementing WCAG guidelines and ensuring web applications are accessible to all users across different devices.</p>
                    </div>
                  </div>
                </div>
              </div>

              <h2>Looking Forward</h2>
              <p>
                As we continue through 2025, web development practices will further evolve, embracing new technologies while maintaining a strong foundation in performance, accessibility, and user experience. Staying updated with these trends and best practices is crucial for developers looking to build modern, scalable web applications.
              </p>
            </div>

            <div class="meta-bottom">
              <div class="tags-section">
                <h4>Related Topics</h4>
                <div class="tags">
                @if ($tags->count() == 0)
                    No data available
                @else
                    @foreach ($tags as $tag)
                        <a href="{{ route('blog') }}" class="tag">{{ $tag->tags }}</a>
                    @endforeach
                @endif
                </div>
              </div>
              @php
                $url = url('blog-details/'.$post->slug);
                $photo = url('uploads/posts/'.$post->featured_photo);
                $title = urlencode($post->title);
                $encodedUrl = urlencode($url);
              @endphp
              <div class="share-section">
                <h4>Share Article</h4>
                <div class="social-links">
                  <a href="https://twitter.com/intent/tweet?url={{ $encodedUrl }}&text={{ $title }}" class="share-btn twitter" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i></a>
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedUrl }}" class="share-btn facebook" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $encodedUrl }}" class="share-btn linkedin" target="_blank" rel="noopener"> <i class="bi bi-linkedin"></i> </a>
                  <a href="javascript:void(0)" class="share-btn copy-link" title="Copy Link" data-url="{{ $url }}"> <i class="bi bi-link-45deg"></i> </a>
                </div>
              </div>
            </div>
          </div>

        </article>

      </div>
    </section><!-- /Blog Details Section -->
    <!-- Blog Comments Section -->
    <section id="blog-comments" class="blog-comments section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="blog-comments-4">
          <div class="comments-header">
            <h3 class="title">Community Feedback</h3>
            <div class="comments-stats">
              <span class="count">{{ $total_comments_count }}</span>
              <span class="label">Comments</span>
            </div>
          </div>

          <div class="comments-container">

        @if ($comments->count() == 0)
            <p>No comment available!</p>
        @else
          @foreach ($comments as $comment)

          @php

            //Existing Value Edit or Delete
            $auth_user = Auth::user();
            $auth_agent = Auth::guard('agent')->user();
            $auth_admin = Auth::guard('admin')->user();

          @endphp

            <!-- Comment -->
            <div class="comment-thread">
              <div class="comment-box">
                <div class="comment-wrapper">
                  <div class="avatar-wrapper">
                    @if ($comment->admin?->photo)
                        <img src="{{ asset('uploads/admin/' . $comment->admin->photo) }}" alt="Avatar" loading="lazy">
                    @elseif ($comment->agent?->photo)
                        <img src="{{ asset('uploads/agent/' . $comment->agent->photo) }}" alt="Avatar" loading="lazy">
                    @elseif ($comment->user?->photo)
                        <img src="{{ asset('uploads/user/' . $comment->user->photo) }}" alt="Avatar" loading="lazy">
                    @else
                        <img src="{{ asset('forntend/assets/img/person/person-f-7.webp') }}" alt="Avatar" loading="lazy">
                    @endif
                    <span class="status-indicator"></span>
                  </div>

                  <div class="comment-content">
                    <div class="comment-header">
                      <div class="user-info">
                    @if ($comment->admin?->name)
                        <h4>{{ $comment->admin->name }}</h4>
                        <span class="time-badge">
                            <span>Admin</span><br>
                            <i class="bi bi-clock"></i>
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    @elseif ($comment->agent?->name)
                        <h4>{{ $comment->agent->name }}</h4>
                        <span class="time-badge">
                            <span>Agent</span><br>
                            <i class="bi bi-clock"></i>
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    @elseif ($comment->user?->name)
                        <h4>{{ $comment->user->name }}</h4>
                        <span class="time-badge">
                            <span>User</span><br>
                            <i class="bi bi-clock"></i>
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    @else
                        <h4>{{ $comment->name }}</h4>
                        <span class="time-badge">
                            <span>Guest</span><br>
                            <i class="bi bi-clock"></i>
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    @endif
                      </div>
                      @if ( $auth_user && $auth_user->id == $comment->user_id )
                      <div class="engagement">
                        <a href="{{ route('comment_destroy',$comment->id) }}" onclick="return confirm('Are you sure you want to delete this Comment?');">
                        <span class="likes">
                          <i class="bi bi-trash"> Delete</i>
                        </span>
                        </a>
                      </div>
                      @elseif ( $auth_agent && $auth_agent->id == $comment->agent_id  )
                      <div class="engagement">
                        <a href="{{ route('comment_destroy',$comment->id) }}" onclick="return confirm('Are you sure you want to delete this Comment?');">
                        <span class="likes">
                          <i class="bi bi-trash"> Delete</i>
                        </span>
                        </a>
                      </div>
                      @elseif ( Auth::guard('admin')->check() )
                      <div class="engagement">
                        <a href="{{ route('comment_destroy',$comment->id) }}" onclick="return confirm('Are you sure you want to delete this Comment?');">
                        <span class="likes">
                          <i class="bi bi-trash"> Delete</i>
                        </span>
                        </a>
                      </div>
                      @endif

                    </div>

                    <div class="comment-body">
                      <p>{{ $comment->comment }}</p>
                    </div>
                    <div class="comment-actions">
                    @if ( $auth_user && $auth_user->id == $comment->user_id )
                        <button class="action-btn reply-btn" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment->id }}" aria-label="Reply to comment">
                        <i class="bi bi-pencil-square"></i>
                        {{--edit comments modal --}}
                        <span>Edit</span>
                      </button>
                    @elseif ( $auth_agent && $auth_agent->id == $comment->agent_id )
                        <button class="action-btn reply-btn" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment->id }}" aria-label="Reply to comment">
                        <i class="bi bi-pencil-square"></i>
                        {{--edit comments modal --}}
                        <span>Edit</span>
                      </button>
                    @elseif ( Auth::guard('admin')->check() )
                        <button class="action-btn reply-btn" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment->id }}" aria-label="Reply to comment">
                        <i class="bi bi-pencil-square"></i>
                        {{--edit comments modal --}}
                        <span>Edit</span>
                      </button>
                    @endif
                      <button class="action-btn reply-btn" data-bs-toggle="modal" data-bs-target="#commentModal{{ $comment->id }}" aria-label="Reply to comment">
                        <i class="bi bi-chat"></i>
                        {{-- comments modal --}}
                        <span>Reply</span>
                      </button>
                      <button class="action-btn share-btn" aria-label="Share comment">
                        <i class="bi bi-share"></i>
                        <span>Share</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Replies Container -->
              <div class="replies-container">
                @php
                    $reply_comments = \App\Models\ReplyComment::with(['admin', 'agent', 'user'])->orderBy('id','asc')->where('comment_id',$comment->id)->get();

                @endphp
                @if ($reply_comments->count() !== 0)
                @foreach ($reply_comments as $reply_comment)
                <!-- Reply -->
                <div class="comment-box reply">
                  <div class="comment-wrapper">
                    <div class="avatar-wrapper">
                    @if ($reply_comment->admin?->photo)
                        <img src="{{ asset('uploads/admin/' . $reply_comment->admin->photo) }}" alt="Avatar" loading="lazy">
                    @elseif ($reply_comment->agent?->photo)
                        <img src="{{ asset('uploads/agent/' . $reply_comment->agent->photo) }}" alt="Avatar" loading="lazy">
                    @elseif ($reply_comment->user?->photo)
                        <img src="{{ asset('uploads/user/' . $reply_comment->user->photo) }}" alt="Avatar" loading="lazy">
                    @else
                        <img src="{{ asset('forntend/assets/img/person/person-f-7.webp') }}" alt="Avatar" loading="lazy">
                    @endif
                      <span class="status-indicator"></span>
                    </div>

                    <div class="comment-content">
                      <div class="comment-header">
                        <div class="user-info">
                            @if ($reply_comment->admin?->name)
                            <h4>{{ $reply_comment->admin->name }}</h4>
                            <span class="time-badge">
                                    <span>Admin</span><br>
                                    <i class="bi bi-clock"></i>
                                    {{ $reply_comment->created_at->diffForHumans() }}
                                </span>
                            @elseif ($reply_comment->agent?->name )
                                <h4>{{ $reply_comment->agent->name }}</h4>
                                <span class="time-badge">
                                    <span>Agent</span><br>
                                    <i class="bi bi-clock"></i>
                                    {{ $reply_comment->created_at->diffForHumans() }}
                                </span>
                            @elseif ($reply_comment->user?->name)
                                <h4>{{ $reply_comment->user->name }}</h4>
                                <span class="time-badge">
                                    <span>User</span><br>
                                    <i class="bi bi-clock"></i>
                                    {{ $reply_comment->created_at->diffForHumans() }}
                                </span>
                            @else
                                <h4>{{ $reply_comment->name }}</h4>
                                <span class="time-badge">
                                    <span>Guest</span><br>
                                    <i class="bi bi-clock"></i>
                                    {{ $reply_comment->created_at->diffForHumans() }}
                                </span>
                            @endif
                        </div>
                        @if ( $auth_user && $auth_user->id == $reply_comment->user_id)
                            <div class="engagement">
                                <a href="{{ route('reply_comment_destroy',$reply_comment->id) }}" onclick="return confirm('Are you sure you want to delete this Reply Comment?');">
                                <span class="likes">
                                    <i class="bi bi-trash"> Delete</i>
                                </span>
                                </a>
                            </div>
                        @elseif ( $auth_agent && $auth_agent->id == $reply_comment->agent_id )
                            <div class="engagement">
                                <a href="{{ route('reply_comment_destroy',$reply_comment->id) }}" onclick="return confirm('Are you sure you want to delete this Reply Comment?');">
                                <span class="likes">
                                    <i class="bi bi-trash"> Delete</i>
                                </span>
                                </a>
                            </div>
                        @elseif ( Auth::guard('admin')->check() )
                            <div class="engagement">
                                <a href="{{ route('reply_comment_destroy',$reply_comment->id) }}" onclick="return confirm('Are you sure you want to delete this Reply Comment?');">
                                <span class="likes">
                                    <i class="bi bi-trash"> Delete</i>
                                </span>
                                </a>
                            </div>
                        @endif
                      </div>

                      <div class="comment-body">
                        <p>{{ $reply_comment->comment }}</p>
                      </div>

                      <div class="comment-actions">
                    @if ( $auth_user && $auth_user->id == $reply_comment->user_id )
                        <button class="action-btn reply-btn" data-bs-toggle="modal"  aria-label="Reply to comment" data-bs-target="#editReplyCommentModal{{ $reply_comment->id }}" >
                        <i class="bi bi-pencil-square"></i>
                        {{-- comments modal --}}
                        <span>Edit</span>
                        </button>
                    @elseif ( $auth_agent && $auth_agent->id == $reply_comment->agent_id )
                        <button class="action-btn reply-btn" data-bs-toggle="modal"  aria-label="Reply to comment" data-bs-target="#editReplyCommentModal{{ $reply_comment->id }}" >
                        <i class="bi bi-pencil-square"></i>
                        {{-- comments modal --}}
                        <span>Edit</span>
                        </button>
                    @elseif ( Auth::guard('admin')->check() )
                        <button class="action-btn reply-btn" data-bs-toggle="modal"  aria-label="Reply to comment" data-bs-target="#editReplyCommentModal{{ $reply_comment->id }}" >
                        <i class="bi bi-pencil-square"></i>
                        {{-- comments modal --}}
                        <span>Edit</span>
                        </button>
                    @endif
                        <button class="action-btn reply-btn" data-bs-toggle="modal"  aria-label="Reply to comment" data-bs-target="#commentModal{{ $reply_comment->comment_id }}" >
                        <i class="bi bi-chat"></i>
                        {{-- comments modal --}}
                        <span>Reply</span>
                        </button>
                        <button class="action-btn share-btn" aria-label="Share comment">
                          <i class="bi bi-share"></i>
                          <span>Share</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- Comments Modal -->
                <div class="modal fade" id="commentModal{{ $reply_comment->comment_id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Reply to Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('reply_comment_store',$reply_comment->comment_id) }}" method="post">
                            @csrf
                        @if (Auth::guard('web')->check() || Auth::guard('agent')->check() || Auth::guard('admin')->check())
                        @else
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name*</label>
                            <input type="name" name="name" id="name" class="form-control"  placeholder="Enter your full name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address*</label>
                            <input type="email" name="email" id="email" class="form-control" required="" placeholder="Email Address">
                        </div>
                        @endif
                            <input type="hidden" name="post_id" id="" value="{{ $post->id }}">
                            <textarea class="form-control" name="comment" required=" " rows="4" placeholder="Write your reply..."></textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn"  style="background-color:#4B8E8F; color: #fff;">Comment Reply</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>


                  <!-- Edit Comments Modal -->
                <div class="modal fade" id="editReplyCommentModal{{ $reply_comment->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Edit Reply Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('reply_comment_edit',$reply_comment->id) }}" method="post">
                            @csrf
                        @if (Auth::guard('web')->check() || Auth::guard('agent')->check() || Auth::guard('admin')->check())
                        @else
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name*</label>
                            <input type="name" name="name" id="name" class="form-control"  placeholder="Enter your full name" value="{{ old('name',$reply_comment->name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address*</label>
                            <input type="email" name="email" id="email" class="form-control" required="" placeholder="Email Address" value="{{ old('email',$reply_comment->email) }}">
                        </div>
                        @endif
                            <input type="hidden" name="post_id" id="" value="{{ $post->id }}">
                            <textarea class="form-control" name="comment" required=" " rows="4" placeholder="Write your reply...">{{ old('comment',$reply_comment->comment) }}</textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn"  style="background-color:#4B8E8F; color: #fff;">Update Comment Reply</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                @endforeach
                @endif
              </div>
            </div>
            <!-- Post to Comments Modal -->
            <div class="modal fade" id="commentModal{{ $comment->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reply to Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reply_comment_store',$comment->id) }}" method="post">
                        @csrf
                    @if (Auth::guard('web')->check() || Auth::guard('agent')->check() || Auth::guard('admin')->check())
                    @else
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name*</label>
                        <input type="name" name="name" id="name" class="form-control"  placeholder="Enter your full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address*</label>
                        <input type="email" name="email" id="email" class="form-control" required="" placeholder="Email Address">
                    </div>
                    @endif
                    <input type="hidden" name="post_id" id="" value="{{ $post->id }}">
                    <textarea class="form-control" name="comment" required=" " rows="4" placeholder="Write your reply..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn"  style="background-color:#4B8E8F; color: #fff;">Comment Reply</button>
                </div>
                </form>
                </div>
            </div>
            </div>


            <!-- Post Edit to Comments Modal -->
            <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit to Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('comment_edit',$comment->id) }}" method="post">
                        @csrf
                    @if (Auth::guard('web')->check() || Auth::guard('agent')->check() || Auth::guard('admin')->check())
                    @else
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name*</label>
                        <input type="name" name="name" id="name" class="form-control"  placeholder="Enter your full name" value="{{ old('name',$comment->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address*</label>
                        <input type="email" name="email" id="email" class="form-control" required="" placeholder="Email Address"  value="{{ old('email',$comment->email) }}">
                    </div>
                    @endif
                    <input type="hidden" name="post_id" id="" value="{{ $post->id }}">
                    <textarea class="form-control" name="comment" required=" " rows="4" placeholder="Write your reply...">{{ old('comment',$comment->comment) }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn"  style="background-color:#4B8E8F; color: #fff;">updated Comment Reply</button>
                </div>
                </form>
                </div>
            </div>
            </div>
          @endforeach
        @endif
          </div>
        </div>

      </div>

    </section><!-- /Blog Comments Section -->

    <!-- Blog Comment Form Section -->
    <section id="blog-comment-form" class="blog-comment-form section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <form action="{{ route('comment_store',$post->id) }}" method="post" role="form">
        @csrf
          <div class="form-header">
            <h3>Leave a Comment</h3>
            <p>Your email address will not be published. Required fields are marked *</p>
          </div>

          <div class="row gy-3">
            @if (Auth::guard('web')->check() || Auth::guard('agent')->check() || Auth::guard('admin')->check())
            @else
            <div class="col-md-6">
                <div class="input-group">
                    <label for="name">Full Name *</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name" required>
                    <span class="error-text">Please enter your name</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <label for="email">Email Address *</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address" required>
                    <span class="error-text">Please enter a valid email address</span>
                </div>
            </div>
        @endif
            <div class="col-12">
              <div class="input-group">
                <label for="website">Website</label>
                <input type="url" name="website" id="website" placeholder="Your website (optional)">
              </div>
            </div>

            <div class="col-12">
              <div class="input-group">
                <label for="comment">Your Comment *</label>
                <textarea name="comment" id="comment" rows="5" placeholder="Write your thoughts here..." required=""></textarea>
                <span class="error-text">Please enter your comment</span>
              </div>
            </div>

            <div class="col-12 text-center">
              <button type="submit">Post Comment</button>
            </div>
          </div>

        </form>

      </div>

    </section><!-- /Blog Comment Form Section -->

  </main>


  <script>
document.addEventListener('DOMContentLoaded', function() {
    const copyBtn = document.querySelector('.copy-link');

    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            const link = this.getAttribute('data-url');
            navigator.clipboard.writeText(link)
                .then(() => {
                    // Optional: show temporary tooltip or alert
                    alert('Link copied to clipboard!');
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                });
        });
    }
});
</script>


@endsection
