<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Mailshot</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @unless($mode)
                                <button class="button success" wire:click="mode('1')">New Email</button>
                                @isset($maillist)
                                    <button wire:click="resetlist" class="button alert">Hide List</button>
                                @endisset
                            @endunless

                            @isset($mailshot)
                            @endisset

                            @isset($mode)
                                @isset($mailshot)
                                    @unless($mode == 1)
                                        @if($edit)
                                            <button class="button alert" wire:click="$toggle('edit')">Cancel</button>
                                        @else
                                            <a href="/admin/mailshot/{{ $mailshot->id }}/preview" class="button success">Preview</a>
                                            <button class="button warning" wire:click="editMail">Edit Mail</button>
                                        @endif
                                    @endunless
                                @endisset

                                @unless($edit)
                                <button class="button alert" wire:click="$set('mode', null)">Cancel</button>
                                @endunless
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
            <div class="cell small-12">
                <form wire:submit.prevent="saveMailshot">
                    <label for="">Title @error('title')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" placeholder="" wire:model.live="title">

                    <label for="">Subject @error('subject')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" placeholder="" wire:model.live="subject">

                    <label for="">Body @error('body')<span class="error">{{ $message }}</span>@enderror</label>
                    <textarea wire:model.live="body" cols="50" rows="10"></textarea>

                    <label for="">Link (optional) @error('link')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" placeholder="" wire:model.live="link">

                    <button class="button success">Save & Continue</button>
                </form>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    @elseif($mode == 2)
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
            @if($edit)
                <form wire:submit.prevent="updateMail">
                    <label for="">Title @error('title')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" placeholder="" wire:model.live="title">

                    <label for="">Subject @error('subject')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" placeholder="" wire:model.live="subject">

                    <label for="">Body @error('body')<span class="error">{{ $message }}</span>@enderror</label>
                    <textarea wire:model.live="body" cols="50" rows="10"></textarea>

                    <label for="">Link (optional) @error('link')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" placeholder="" wire:model.live="link">

                    <button class="button success">Save Changes</button>
                </form>

            @else
                <p><strong>Subject:</strong> {{ $mailshot->subject }}<br>
                <strong>Title:</strong> {{ $mailshot->title }}<br>
                <strong>Body:</strong><br> {!! nl2br(e($mailshot->body)) !!}</p>
                <div class="grid-x grid-padding-x">
                    @isset($mailshot->scheduled)
                    <div class="cell small-12">   
                        <strong>Scheduled for: </strong> {{ date('j/m/y H:i', strtotime ($mailshot->scheduled)) }} - @if($mailshot->sent == Null)<button wire:click="rescheduleEmail">Reschedule</button>@endif
                        </form>
                    </div><!-- End of cell-->
                    @endisset
                    
                    @empty($mailshot->scheduled)
                        <div class="cell small-12 medium-3">
                            <strong>Schedule:</strong>
                        </div>
                        <div class="cell small-12 medium-3">
                            <input type="text" id="datepicker" placeholder="dd/mm/yy" wire:model.live="date">
                        </div><!-- End of cell-->
                        <div class="cell small-12 medium-3">
                            <select id="" wire:model.live="time" required>
                                <option>Please Select</option>
                                <option value="00:00">12:00 AM</option>
                                <option value="00:30">12:30 AM</option>
                                <option value="01:00">01:00 AM</option> 
                                <option value="01:30">01:30 AM</option> 
                                <option value="02:00">02:00 AM</option> 
                                <option value="02:30">02:30 AM</option> 
                                <option value="03:00">03:00 AM</option> 
                                <option value="03:30">03:30 AM</option> 
                                <option value="04:00">04:00 AM</option> 
                                <option value="04:30">04:30 AM</option> 
                                <option value="05:00">05:00 AM</option> 
                                <option value="05:30">05:30 AM</option> 
                                <option value="06:00">06:00 AM</option> 
                                <option value="06:30">06:30 AM</option> 
                                <option value="07:00">07:00 AM</option> 
                                <option value="07:30">07:30 AM</option> 
                                <option value="08:00">08:00 AM</option> 
                                <option value="08:30">08:30 AM</option> 
                                <option value="09:00">09:00 AM</option> 
                                <option value="09:30">09:30 AM</option> 
                                <option value="10:00">10:00 AM</option> 
                                <option value="10:30">10:30 AM</option> 
                                <option value="11:00">11:00 AM</option> 
                                <option value="11:30">11:30 AM</option> 

                                <option value="12:00">12:00 PM</option>
                                <option value="12:30">12:30 PM</option>
                                <option value="13:00">01:00 PM</option> 
                                <option value="13:30">01:30 PM</option> 
                                <option value="14:00">02:00 PM</option> 
                                <option value="14:30">02:30 PM</option> 
                                <option value="15:00">03:00 PM</option> 
                                <option value="15:30">03:30 PM</option> 
                                <option value="16:00">04:00 PM</option> 
                                <option value="16:30">04:30 PM</option> 
                                <option value="17:00">05:00 PM</option> 
                                <option value="17:30">05:30 PM</option> 
                                <option value="18:00">06:00 PM</option> 
                                <option value="18:30">06:30 PM</option> 
                                <option value="19:00">07:00 PM</option> 
                                <option value="19:30">07:30 PM</option> 
                                <option value="20:00">08:00 PM</option> 
                                <option value="20:30">08:30 PM</option> 
                                <option value="21:00">09:00 PM</option> 
                                <option value="21:30">09:30 PM</option> 
                                <option value="22:00">10:00 PM</option> 
                                <option value="22:30">10:30 PM</option> 
                                <option value="23:00">11:00 PM</option> 
                                <option value="23:30">11:30 PM</option> 
                            </select>
                        </div><!-- End of cell-->
                        <div class="cell small-12 medium-3">
                            <button class="button expanded" wire:click="scheduleEmail">Schedule Email</button>
                        </div><!-- End of cell-->
                        <div class="cell small-12">
                            @error('date')<span class="error">{{ $message }}</span>@enderror
                            @error('time')<span class="error">{{ $message }}</span>@enderror
                              
                        </div><!-- End of cell-->
                    @endempty
                </div><!--end of grid-x -->
                @isset($mailshot->scheduled)
                    @if($mailshot->sent == Null)
                        <button class="button button success expanded" wire:click="processMailshot">Send Mail</button>
                    @endif
                @endisset
            @endif
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    @else
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <td class="text-center">Subscribed</td>
                            <td class="text-center">Unsubscribed</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $subscribers->count() }}</td>
                            <td class="text-center">{{ $unsubs->count() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @isset($maillist)
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Joined</td>
                            <td>Online</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->firstName }}</td>
                            <td>{{ $subscriber->email }}</td>
                            <td></td>  
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="table-scroll">
                <table class="striped">
                <thead>
                    <tr>
                        <td>Mailshots</td>
                        <td>Created</td>
                        <td>Processed</td>
                        <td>Scheduled</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mailshots as $mailshot)
                    <tr>
                        <td>{{ $mailshot->subject }}</td>
                        <td>{{ date('j/m/y', strtotime ($mailshot->created_at)) }}</td>
                        <td>
                            @if($mailshot->sent == 0) No @else Yes @endif
                        </td>
                        <td>
                            @isset($mailshot->scheduled) {{ date('j/m/y H:i', strtotime ($mailshot->scheduled)) }} @else Not Set @endif
                        </td>
                        <td>
                            @if($mailshot->sent == 0)
                                <button wire:click="mailshotToReview('{{ $mailshot->id }}')">Review</a>
                            @endif
                        </td> 
                        <td><a href="/admin/mailshot/{{ $mailshot->id }}/preview">HTML Preview</a></td>
                        <td class="text-right">
                            @if($mailshot->sent == 0)
                                <button wire:click="delete('{{ $mailshot->id }}')">Delete</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
                  
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    @endif
</div>
