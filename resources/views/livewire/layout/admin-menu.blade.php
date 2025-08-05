<div>
    @if(Auth::user()->email == 'fishlist@redwoodlake.co.uk')
    <i class="fas fa-fish"></i> <a href="/admin/catch-reports">Reports</a><br>
    <i class="fas fa-fish"></i> <a href="/admin/stock">Fish List</a><br>
    <i class="fas fa-fish"></i> <a href="/admin/stocking-diary">Stock Diary</a><br>
    @else
    <i class='far fa-user-circle'></i> <a href="/admin/dashboard">Dashboard</a><br>
    <i class="far fa-calendar"></i> <a href="/admin/bookings">Bookings</a><br>
    <i class="far fa-user"></i> <a href="/admin/anglers">Anglers</a><br>

    <i class="fas fa-fish"></i> <a href="/admin/catch-reports">Reports</a><br>
    <i class="fas fa-fish"></i> <a href="/admin/stock">Fish List</a><br>
    <i class="fas fa-fish"></i> <a href="/admin/stocking-diary">Stock Diary</a><br>
    <i class="fas fa-map-marker-alt"></i> <a href="/admin/lake">Lake Info</a><br>

    <i class="far fa-newspaper"></i> <a href="/admin/news">News</a><br>
    <i class="fas fa-camera"></i> <a href="/admin/photo-diary">Photo Diary</a><br>
    <i class="fas fa-pencil-alt"></i> <a href="/admin/content">Content</a><br>
    <i class="fas fa-list-ol"></i> <a href="/admin/rules">Rules</a><br>
    <i class="fas fa-list-ol"></i> <a href="/admin/booking-terms">Booking t&c</a><br>
    <i class="fas fa-comment-alt"></i> <a href="/admin/reviews">Reviews</a><br>

    <i class="fas fa-pound-sign"></i> <a href="/admin/pricing">Pricing</a><br>
    <i class="fas fa-pound-sign"></i> <a href="/admin/payments">Payments</a><br>
    <i class="fab fa-cc-stripe"></i> <a href="/admin/payouts">Payouts</a><br>
    <i class="fas fa-tag"></i> <a href="/admin/discounts">Discounts</a><br>
    <i class="fas fa-file-invoice"></i> <a href="/admin/financial">Financial</a><br>

    <i class="far fa-envelope"></i> <a href="/admin/mailing-list">Mailing List</a><br>
    <i class="far fa-envelope"></i> <a href="/admin/inbox">Inbox</a><br>
    <i class="far fa-envelope"></i> <a href="/admin/emails">Email Preview</a><br>
    <i class="fas fa-cog"></i> <a href="/admin/settings">Settings</a><br>
    <i class="fas fa-cog"></i> <a href="/admin/storage">Storage</a><br>
    
    @endif
    <i class='fas fa-power-off'></i> <a href="/logout">Logout</a>
</div>
