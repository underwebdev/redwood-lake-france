@if(session('success'))
<div class="grid-x grid-padding-x">
<div class="cell small-12">
    <div class="callout success text-center">
        <p><strong>{{ session('success') }}</strong></p>
    </div>
</div>
</div><!--end of grid-x -->
@endif