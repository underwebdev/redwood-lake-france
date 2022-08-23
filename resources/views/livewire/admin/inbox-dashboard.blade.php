<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Inbox</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                                <button class="button warning" wire:click="$set('mode', 2)">View Archive</button>
                            @elseif($mode == 2)
                                <button class="button warning" wire:click="$set('mode', 1)">View Inbox</button>
                            @endif 

                            @if($mode == 3)
                                <button class="button alert" wire:click="$set('mode', 1)">Go Back</button>
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
            @unless($selectedMessage)
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Sender</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($mode == 1)
                                @foreach($messages as $message)
                                <tr>
                                    <td>{{ date('j/m/y H:i', strtotime ($message->created_at)) }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td class="text-right">
                                        <button class="button success" wire:click="selectMessage('{{ $message->id }}')">View</button>
                                    </td>
                                </tr>
                                @endforeach
                            @elseif($mode == 2)
                                @foreach($archives as $archive)
                                <tr>
                                    <td>{{ date('j/m/y H:i', strtotime ($archive->created_at)) }}</td>
                                    <td>{{ $archive->name }}</td>
                                    <td class="text-right">
                                        <button class="button success" wire:click="selectMessage('{{ $archive->id }}')">View</button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>    
            </div><!-- End of cell-->
            @else
            <div class="grid-x grid-padding-x">
                <div class="cell small-12 medium-4">
                    <div class="">
                        <p><strong>Name:</strong> {{ $$selectedMessage->name }}</p>
                        <p><strong>Telephone:</strong> {{ $selectedMessage->telephone }}</p>
                        <p><strong>Email:</strong> {{ $selectedMessage->email }}</p>
                    </div>
                    <div class="button-group expanded">
                        <button class="button warning" wire:click="archiveMessage('{{ $selectedMessage->id }}')">Archive</button>
                        <button class="button alert" wire:click="deleteMessage('{{ $selectedMessage->id }}')">Delete</button>
                    </div>
                </div><!-- End of cell-->
                <div class="cell small-12 medium-8">
                    <p>{!! nl2br(e($selectedMessage->message)) !!}</p>
                </div><!-- End of cell-->
            </div><!--end of grid-x -->
            @endunless
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>
