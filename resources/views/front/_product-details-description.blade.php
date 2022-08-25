<div class="row">
    <div class="col-lg-12">
        <div id="product-details-tab">
            <div class="top-menu-area">
                <ul class="tab-menu">
                    <li><a href="#tabs-1">{{ __('DESCRIPTION') }}</a></li>
                    <li><a href="#tabs-2">{{ __('BUY & RETURN POLICY') }}</a></li>
                    @if ($gs->is_rating == 1)
                        <li><a href="#tabs-3">{{ __('Reviews') }}({{ count($productt->ratings) }})</a></li>
                    @endif
                    @if ($gs->is_comment == 1)
                        <li>
                            <a href="#tabs-4">{{ __('Comment') }}
                                (<span id="comment_count">{{ count($productt->comments) }}</span>)
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="tab-content-wrapper">
                <div id="tabs-1" class="tab-content-area">
                    <p>{!! nl2br($productt->details) !!}</p>
                </div>
                <div id="tabs-2" class="tab-content-area">
                    @if ($gs->policy)
                        <p>{!! $gs->policy !!}</p>
                    @elseif($productt->policy)
                        <p>{!! $productt->policy !!}</p>
                    @endif
                </div>
                @if ($gs->is_rating == 1)
                    <div id="tabs-3" class="tab-content-area">
                        <div class="heading-area">
                            <h4 class="title">
                                {{ __('Ratings & Reviews') }}
                            </h4>
                            <div class="reating-area">
                                <div class="stars">
                                    <span id="star-rating">{{ App\Models\Rating::rating($productt->id) }}</span>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div id="replay-area">
                            <div id="reviews-section">
                                @if (count($productt->ratings) > 0)
                                    <ul class="all-replay">
                                        @foreach ($productt->ratings as $review)
                                            <li>
                                                <div class="single-review">
                                                    <div class="left-area">
                                                        <img src="{{ $review->user->photo
                                                            ? asset('storage/images/users/' . $review->user->photo)
                                                            : asset('assets/images/noimage.png') }}"
                                                            alt="">
                                                        <h5 class="name">{{ $review->user->name }}</h5>
                                                        <p class="date">
                                                            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $review->review_date)->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    <div class="right-area">
                                                        <div class="header-area">
                                                            <div class="stars-area">
                                                                <ul class="stars">
                                                                    <div class="ratings">
                                                                        <div class="empty-stars"></div>
                                                                        <div class="full-stars"
                                                                            style="width:{{ $review->rating * 20 }}%">
                                                                        </div>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="review-body">
                                                            <p>
                                                                {{ $review->review }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>{{ __('No Review Found.') }}</p>
                                @endif
                            </div>
                            @if (Auth::guard('web')->check())
                                <div class="review-area">
                                    <h4 class="title">{{ __('Review') }}</h4>
                                    <div class="star-area">
                                        <ul class="star-list">
                                            <li class="stars" data-val="1">
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="stars" data-val="2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="stars" data-val="3">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="stars" data-val="4">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="stars active" data-val="5">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="write-comment-area">
                                    <div class="gocover"
                                        style="background: url({{ asset('storage/images/' . $gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                    </div>
                                    <form id="reviewform" action="{{ route('front.review.submit') }}"
                                        data-href="{{ route('front.reviews', $productt->id) }}" method="POST">
                                        @include('includes.admin.form-both')
                                        {{ csrf_field() }}
                                        <input type="hidden" id="rating" name="rating" value="5">
                                        <input type="hidden" name="user_id"
                                            value="{{ Auth::guard('web')->user()->id }}">
                                        <input type="hidden" name="product_id" value="{{ $productt->id }}">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="review" placeholder="{{ __('Your Review') }}" required>
                                            </textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button class="submit-btn" type="submit">
                                                    {{ __('SUBMIT') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <br>
                                        <h5 class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"
                                                class="btn login-btn mr-1">
                                                {{ __('Login') }}
                                            </a>
                                            {{ __('To Review') }}
                                        </h5>
                                        <br>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                @if ($gs->is_comment == 1)
                    <div id="tabs-4" class="tab-content-area">
                        <div id="comment-area">
                            @include('includes.comment-replies')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
