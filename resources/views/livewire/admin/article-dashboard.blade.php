<div>
    <div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Article</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            
                            
                            @if($mode == 1)
                                <button class="button success" wire:click="$set('mode', 3)">Edit</button>
                                <a href="/admin/news" class="button warning">Back To News</a>
                                <button class="button alert" wire:click="$set('mode', 2)">Delete</button>
                            @else
                                @unless($article->url == Null)
                                    @isset($article->draft)
                                        <button class="button success" wire:click="publish">Publish</button>
                                    @else
                                        <button class="button warning" wire:click="unpublish">Unpublish</button>
                                    @endif
                                @endunless
                                <button class="button alert" wire:click="$set('mode', 1)">Cancel</button>
                            @endif

                        </div><!-- End of cell-->
                    </div>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @include('layout.alerts')
        @if($article->url == Null)
        <div class="grid-x grid-padding-x">
        <div class="cell small-12">
            <div class="callout alert text-center">
                <p><strong>Article cannot be published until metadata has been set.</strong></p>
            </div>
        </div>
        </div><!--end of grid-x -->
        @endif
        @if($article->draft == 1)
        <div class="grid-x grid-padding-x">
        <div class="cell small-12">
            <div class="callout alert text-center">
                <p><strong>This article is a draft and is not publicly visible</strong></p>
            </div>
        </div>
        </div><!--end of grid-x -->
        @endif
    </div><!--End of grid container-->
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            @if($mode == 1)
                <div class="cell small-12 large-8 large-offset-2">
                    
                    <img src="/assets/article-cover/{{ $article->id }}">

                    <div class="profilewhitebx">
                        <h1>{{ $article->title }}</h1>
                        <nav aria-label="You are here:" role="navigation">
                        <ul class="breadcrumbs">
                            @foreach($article->breadcrumbs as $breadcrumb)
                            <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                            @endforeach
                        </ul>
                        </nav>

                        <p><small>{{ $article->created_at->diffForHumans() }}</small><br>
                            {!! nl2br(e($article->body)) !!}
                        </p>

                        
                    </div>
                </div><!-- End of cell-->

                
                    <div class="cell small-12 large-8 large-offset-2">
                        <br>
                        <h4>Add photos to this articles gallery</h4>
                        <input type="file" wire:model="gallery">       
                    

                        @if($article->images()->count() > 0)
                        <div class="grid-x grid-padding-x">
                            @foreach($article->images as $image)
                            <div class="cell small-12 medium-6 ml-4 large-4 xlarge-3 text-center">
                                <div class="photo-border-block">
                                    <a href="/assets/article-gallery/{{ $image->id }}.{{ Str::afterLast($image->image, '.') }}" data-lity>
                                    <img src="/assets/article-gallery/{{ $image->id }}.{{ Str::afterLast($image->image, '.') }}">
                                    </a>
                                </div>

                                <button class="button alert expanded" wire:click="deleteFromGallery('{{ $image->id }}')">Delete</button>
                            </div>
                            @endforeach
                        </div><!--end of grid-x -->
                        @endif
                    </div><!-- End of cell-->
            @elseif($mode == 2)
                <div class="cell small-12 text-center">
                      <h3>Are you sure you want to delete this article?</h3>
                      <p><span class="error">This action cannot be undone</span></p>
                      <button class="button alert" wire:click="delete">Delete Article</button>
                </div><!-- End of cell-->
            @elseif($mode == 3)
                <div class="cell small-12 large-8 large-offset-2">
                    <img src="/assets/article-cover/{{ $article->id }}">
                    <br><br>
                    <input type="file" wire:model="cover">
                    
                    <form wire:submit.prevent="saveChanges">
                        <label for="">Title</label>
                        <input type="text" placeholder="" wire:model="title">

                        <label for="">Body</label>
                        <textarea wire:model="body" cols="50" rows="10"></textarea>

                        <hr>

                        <label for="">Url (https://redwoodlake.co.uk/news/)
                            @error('url')<span class="error">{{ $message }}</span>@enderror
                        </label>
                        <input type="text" placeholder="" wire:model="url">

                        <label for="">Meta Title
                            @error('metatitle')<span class="error">This field is required if the article is active.</span> @enderror
                        </label>
                        <input type="text" placeholder="" wire:model="metatitle">

                        <label for="">Meta Description
                            @error('metadesc')<span class="error">This field is required if the article is active.</span> @enderror
                        </label>
                        <input type="text" placeholder="" wire:model="metadesc">

                        <label for="">Meta Keywords
                            @error('metakeywords')<span class="error">This field is required if the article is active.</span> @enderror
                        </label>
                        <input type="text" placeholder="" wire:model="metakeywords">

                        <button class="button success">Save Changes</button>
                    </form>

                    @foreach($article->breadcrumbs as $breadcrumb)
                    <div class="grid-x grid-padding-x">
                        <div class="cell auto">
                            {{ $breadcrumb->title }}
                        </div>
                        <div class="cell auto">
                            {{ $breadcrumb->url }}
                        </div>
                        <div class="cell auto text-right">
                            <button class="button alert tiny" wire:click="deleteBreadcrumb('{{ $breadcrumb->id }}')">Delete</button>
                        </div>
                    </div>
                    @endforeach

                    

                    @if($createBreadcrumb)
                    
                    <label for="">Breadcrumb Title</label>
                    <input type="text" placeholder="" wire:model="breadcrumbtitle">

                    <label for="">Breadcrumb URL</label>
                    <input type="text" placeholder="" wire:model="breadcrumburl">

                    <div class="button-group stacked">
                        <button class="button success" wire:click="saveBreadcrumb">Save Breadcrumb</button>

                        <button class="button alert" wire:click="$toggle('createBreadcrumb')">Cancel</button>
                    </div>
                    @else
                    <button class="" wire:click="$toggle('createBreadcrumb')">Add Breadcrumb +</button>
                    @endif

                    <br>
                    <br>
                      
                </div><!-- End of cell-->
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>
</div>
