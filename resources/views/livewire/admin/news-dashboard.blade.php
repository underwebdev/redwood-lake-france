<div>
    <div class="grid-container full">
	    <div class="grid-x grid-padding-x">
	        <div class="cell small-12">
	            <div class="admin-title-panel">
	                <div class="grid-x">
	                    <div class="cell small-12 medium-6">
	                        <h1>News</h1>
	                    </div>
	                    <div class="cell small-12 medium-6 text-right align-self-middle">
	                    	@unless($mode)
                        	<button class="button success" wire:click="$set('mode', 1)">New Article</button>
                        	@endunless
	                        @isset($mode)
	                        	<button class="button alert" wire:click="$set('mode', null)">Cancel</button>
	                        @endif

	                    </div><!-- End of cell-->
	                </div>
	            </div>
	        </div><!-- End of cell-->
	    </div><!--end of grid-x -->
	    @include('layout.alerts')
	</div><!--End of grid container-->
		@if($mode == 1)
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
					<form wire:submit.prevent="saveArticle">
						<label for="">Title @error('title')<span class="error">{{ $message }}</span>@enderror</label>
						<input type="text" placeholder="" wire:model="title">

						<label for="">Body @error('body')<span class="error">{{ $message }}</span>@enderror</label>
						<textarea wire:model="body" cols="25" rows="10"></textarea>

						<label for="">Cover Image (1200px x 900px) @error('cover')<span class="error">{{ $message }}</span>@enderror</label>
						<input type="file" placeholder="" wire:model="cover">

						<hr>

						<label for="">Url (https://etangdeseuil.co.uk/news/)
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

		                <label for="">Status</label>
		                <select id="" wire:model="status">
		                	<option value="1">Draft</option>
		                	<option value="2">Active</option>
		                </select>

						<button class="button success">Save Article</button>
					</form>
				      
				</div><!-- End of cell-->
			</div>
		</div>
		@else			
		<div class="grid-container full">
			<div class="grid-x grid-padding-x" data-equalizer>
				@foreach($articles as $article)
				<div class="cell small-12 medium-6 large-4">
					<div class="news-holder" data-equalizer-watch>
						<div class="news-thumb">
							<img src="{{ $article->thumbnail }}">
						</div>
						<h5 class="heading-font"><strong>{{ $article->title }}</strong></h5>
						<small><i class="far fa-calendar-alt"></i> {{ date('j M Y', strtotime ($article->created_at)) }} <span class="seperator">/</span> {{ date('H:i A', strtotime ($article->created_at)) }}</small><br>
				    </div>
				    <a href="/admin/article/{{ $article->id }}" class="button expanded">View Article</a>
				</div><!-- End of cell-->
				@endforeach
			</div><!--end of grid-x -->
		</div><!--End of grid container-->
		@endif
</div>
