<div>
    @section('header_title', 'Review Moderation')
    
    <div class="card-premium">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="table-responsive" style="min-height: 300px; overflow: visible;">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>User</th>
                        <th>Rating & Review</th>
                        <th>Status</th>
                        <th>Admin Reply</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td style="max-width: 150px;">
                                <div class="text-truncate" title="{{ $review->product->name ?? 'Unknown' }}">
                                    {{ $review->product->name ?? 'Unknown' }}
                                </div>
                            </td>
                            <td>{{ $review->user->name ?? 'Guest' }}</td>
                            <td style="max-width: 300px;">
                                <div class="text-warning mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'text-muted opacity-25' }}"></i>
                                    @endfor
                                </div>
                                <div class="text-truncate" title="{{ $review->review_text }}">
                                    {{ $review->review_text }}
                                </div>
                            </td>
                            <td>
                                @if($review->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($review->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($replyingTo === $review->id)
                                    <div class="d-flex flex-column gap-2">
                                        <textarea wire:model="replyContent" class="form-control form-control-sm" rows="2" placeholder="Write reply..."></textarea>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-sm btn-primary" wire:click="saveReply">Save</button>
                                            <button class="btn btn-sm btn-outline-secondary" wire:click="cancelReply">Cancel</button>
                                        </div>
                                    </div>
                                @else
                                    @if($review->admin_reply)
                                        <div class="text-truncate text-muted" style="max-width: 150px;" title="{{ $review->admin_reply }}">
                                            <i class="fa-solid fa-reply fa-xs me-1"></i> {{ $review->admin_reply }}
                                        </div>
                                        <button class="btn btn-link btn-sm p-0 text-decoration-none mt-1" wire:click="initiateReply({{ $review->id }})">Edit Reply</button>
                                    @else
                                        <button class="btn btn-outline-primary btn-sm" wire:click="initiateReply({{ $review->id }})">Add Reply</button>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Change Status
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button class="dropdown-item" wire:click="updateStatus({{ $review->id }}, 'approved')"><i class="fa-solid fa-check text-success me-2"></i>Approve</button></li>
                                        <li><button class="dropdown-item" wire:click="updateStatus({{ $review->id }}, 'rejected')"><i class="fa-solid fa-times text-danger me-2"></i>Reject</button></li>
                                        <li><button class="dropdown-item" wire:click="updateStatus({{ $review->id }}, 'pending')"><i class="fa-solid fa-clock text-warning me-2"></i>Pending</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No reviews found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
