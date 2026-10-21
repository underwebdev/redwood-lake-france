<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>@isset($selectedPage) {{ $selectedPage->name }} @endisset Content</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                            <button class="button success" wire:click="$set('mode', 2)">New Page</button>
                            @else
                            @isset($selectedPage)
                                @unless($mode == 4)
                                    <button class="button warning" wire:click="$set('mode', 4)">Update</button>
                                @endunless
                            @endisset
                            <button class="button alert" wire:click="back">Go Back</button>
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
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>#</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->id }}</td>
                                <td class="text-right">
                                    <button class="button success small" wire:click="selectPage('{{ $page->id }}')">View</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>  
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                Create Page
                <label for="">Page Name
                    @error('name')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="name">

                <label for="">Url
                    @error('url')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model.live="url">

                <label for="">Meta Title
                    @error('metatitle')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="metatitle">

                <label for="">Meta Description
                    @error('metadesc')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="metadesc">

                <label for="">Meta Keywords
                    @error('metakeywords')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="metakeywords">

                <label for="">Heading
                    @error('heading')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="heading">

                <label for="">Sub Heading</label>
                <input type="text" placeholder="" wire:model.live="subheading">

                <label for="">CTA Button</label>
                <input type="text" placeholder="" wire:model.live="ctabutton">

                <label for="">CTA Link</label>
                <input type="text" placeholder="" wire:model.live="ctalink">

                <button class="button success" wire:click="savePage">Save Page</button>

            </div>
            @elseif($mode == 3)
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Url</th>
                                <td class="text-right">Last Updated</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $selectedPage->id }}</td>
                                <td>{{ $selectedPage->name }}</td>
                                <td>{{ $selectedPage->url }}</td>
                                <td class="text-right">{{ date('j/m/y H:i', strtotime ($selectedPage->updated_at)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p><strong>Meta Title:</strong> {{ $selectedPage->metatitle }}</p>
                <p><strong>Meta Description:</strong> {{ $selectedPage->metadescription }}</p>
                <p><strong>Meta Keywords:</strong> {{ $selectedPage->metakeywords }}</p>
                <p><strong>Main Heading:</strong> {{ $selectedPage->heading }}</p>
                @isset($selectedPage->subheading)
                <p><strong>Subheading:</strong> {{ $selectedPage->subheading }}</p>
                @endisset

                @isset($selectedPage->ctabutton)
                <p><strong>CTA Button text:</strong> {{ $selectedPage->ctabutton }}</p>
                @endisset

                @isset($selectedPage->ctalink)
                <p><strong>CTA Link:</strong> {{ $selectedPage->ctalink }}</p>
                @endisset 

                @unless($module)
                <button class="button" wire:click="$set('module', true)">Create Module</button>
                @endunless
                @if($mode != 6)
                <button class="button success" wire:click="$set('mode', '6')">Add To Gallery</button>
                @endif

                @if($module)
                <label for="">Title</label>
                <input type="text" placeholder="" wire:model.live="title">

                <label for=""></label>
                <textarea wire:model.live="content" cols="50" rows="10"></textarea>

                <button class="button success" wire:click="saveModule">Save Module</button>
                <button class="button alert" wire:click="$set('module', false)">Cancel</button>
                @endif

                @foreach($selectedPage->modules as $module)
                <h5><strong>{{ $module->title }}</strong></h5>
                <p>{!! nl2br(e($module->content)) !!}</p>
                <button class="button warning" wire:click="selectModule('{{ $module->id }}')">Update Module</button>
                @endforeach

                @if($selectedPage->gallery()->exists())
                <div class="grid-x grid-padding-x">
                    <div class="cell small-12">
                        <h5>Page Gallery</h5>      
                    </div><!-- End of cell-->
                    @foreach($selectedPage->gallery as $image)
                    <div class="cell small-6 medium-4 large-3">
                        <img src="{{ $image->mobile }}">
                        <button class="button expanded alert" wire:click="deleteImage('{{ $image->id }}')">Delete Image</button>  
                    </div><!-- End of cell-->
                    @endforeach
                </div><!--end of grid-x -->
                @endif

            </div>
            @elseif($mode == 4)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                Create Page
                <label for="">Page Name
                    @error('name')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="name">

                <label for="">Url
                    @error('url')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model.live="url">

                <label for="">Meta Title
                    @error('metatitle')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="metatitle">

                <label for="">Meta Description
                    @error('metadesc')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="metadesc">

                <label for="">Meta Keywords
                    @error('metakeywords')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="metakeywords">

                <label for="">Heading
                    @error('heading')<span class="error">{{ $message }} </span> @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="heading">

                <label for="">Sub Heading</label>
                <input type="text" placeholder="" wire:model.live="subheading">

                <label for="">CTA Button</label>
                <input type="text" placeholder="" wire:model.live="ctabutton">

                <label for="">CTA Link</label>
                <input type="text" placeholder="" wire:model.live="ctalink">

                <button class="button success" wire:click="savePageChanges">Save Page</button>
                <button class="button alert" wire:click="$set('mode', 3)">Cancel</button>
            @elseif($mode == 5)
            <div class="cell small-12">
                <label for="">Title</label>
                <input type="text" placeholder="" wire:model.live="title">

                <label for=""></label>
                <textarea wire:model.live="content" cols="50" rows="10"></textarea>

                <button class="button success" wire:click="saveModuleChanges">Save Changes</button>
                <button class="button alert" wire:click="$set('mode', 3)">Cancel</button>
            </div><!-- End of cell-->
            @elseif($mode == 6)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <p>Image aspect ratio must be 2:1, files will be automatically cropped to 1400px x 750px</p>
                <label>@error('file')<span class="error">{{ $message }}</span>@enderror
                </label> 
                <input type="file" wire:model.live="photo">
                <label for="">Alt Text
                    @error('alt')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <input type="text" placeholder="" wire:model.live="alt">
                <div class="button-group">
                    <button class="button success" wire:click="saveImage">Upload Image</button>
                    <button class="button alert" wire:click="$set('mode', 3)">Cancel</button>
                </div>
            </div><!-- End of cell-->
            @endif 
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>
