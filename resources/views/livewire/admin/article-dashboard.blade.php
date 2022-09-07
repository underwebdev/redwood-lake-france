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
                                @isset($article->draft)
                                    <button class="button success" wire:click="publish">Publish</button>
                                @else
                                    <button class="button warning" wire:click="unpublish">Unpublish</button>
                                @endif
                                <button class="button alert" wire:click="$set('mode', 1)">Cancel</button>
                            @endif

                        </div><!-- End of cell-->
                    </div>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @include('layout.alerts')
    </div><!--End of grid container-->
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            @if($mode == 1)
                <div class="cell small-12 large-8 large-offset-2">
                    
                    <img src="{{ $article->cover }}">

                    <div class="profilewhitebx">
                        <h1>{{ $article->title }}</h1>
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
                                    <a href="{{ $image->image }}" data-lity>
                                    <img src="{{ $image->image }}">
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
                    <img src="{{ $article->cover }}">
                    <br><br>
                    <input type="file" wire:model="cover">
                    
                    <form wire:submit.prevent="saveChanges">
                        <label for="">Title</label>
                        <input type="text" placeholder="" wire:model="title">

                        <label for="">Body</label>
                        <textarea wire:model="body" cols="50" rows="10"></textarea>

                        <button class="button success">Save Changes</button>
                    </form>
                      
                </div><!-- End of cell-->
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>
</div>
