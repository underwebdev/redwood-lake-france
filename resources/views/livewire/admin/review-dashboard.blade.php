<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Reviews</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                            <button class="button success" wire:click="$set('mode', 2)">New Review</button>
                            @else
                            <button class="button warning" wire:click="back">Go Back</button>
                            <button class="button alert" wire:click="deleteReview">Delete</button>
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
                                <th>Review</th>
                                <th>Name</th>
                                <th class="text-center">Featured</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr>
                                <td>{!! nl2br(e($review->body)) !!}</td>
                                <td>{{ $review->name }}</td>
                                <td class="text-center">@if($review->featured == 1) <i class="fas fa-star"></i> @endif </td>
                                <td class="text-right"><button class="button success" wire:click="selectReview('{{ $review->id }}')">Update</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Review</label>
                <textarea wire:model="body" cols="50" rows="10"></textarea>
                <label for="">Name</label>
                <input type="text" placeholder="" wire:model="name">
                <label for="">Featured</label>
                <select id="" wire:model="featured">
                    <option value="">No</option>
                    <option value="1">Yes</option> 
                </select>
                <button class="button success" wire:click="saveReview">Save Review</button>
            </div>
            @elseif($mode == 3)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Review</label>
                <textarea wire:model="body" cols="50" rows="10"></textarea>
                <label for="">Name</label>
                <input type="text" placeholder="" wire:model="name">
                <label for="">Featured</label>
                <select id="" wire:model="featured">
                    <option value="">No</option>
                    <option value="1">Yes</option> 
                </select>
                <button class="button success" wire:click="saveReviewChanges">Save Changes</button>
            </div>
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>
