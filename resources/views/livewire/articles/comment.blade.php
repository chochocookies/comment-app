<div>
    <h3 class="mb-4">( {{ $total_comments }} ) Comments</h3>
    @auth

    <form wire:submit.prevent="store" class="mb-4">
        <div class="mb-3">
            <textarea wire:model.defer="body" rows="2" class="form-control @error('body') is-invalid @enderror" placeholder="Tulis komentar"></textarea>
            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    @endauth

    @guest
        <div class="alert alert-primary" role="alert">
            Login dulu untuk berkomentar <a href="{{ route('login') }}">klik disini</a>
        </div>
    @endguest

    @foreach ($comments as $item)
    <div class="mb-3" id="comment-{{ $item->id }}">
        <div class="d-flex align-items-start mb-3">
            <img src="" alt="users" width="30px">
            <div>
                <div>
                    <span>{{ $item->user->name }}</span>
                    <span>{{ $item->created_at }}</span>
                </div>
                <div class="text-secondary mb-2"> <!-- FIXED: corrected "tect-secondary" to "text-secondary" -->
                    {{ $item->body }}
                </div>
                <div>
                    @auth
                    <button class="btn btn-sm btn-primary" wire:click="selectReply({{ $item->id }})">Balas</button>
                    @if ($item->user_id == Auth::user()->id)
                    <button class="btn btn-sm btn-warning" wire:click="selectEdit({{ $item->id }})">Edit</button>
                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                    @endif
                    @if ($item->hasLike)
                        <button wire:click="like({{
                        $item->id }})" class="btn btn-sm btn-danger"><i class="bi bi-heart-fill"></i>({{ $item->totalLikes() }})</button>
                        @else
                        <button wire:click="like({{
                        $item->id }})" class="btn btn-sm btn-dark"><i class="bi bi-heart-fill"></i>({{ $item->totalLikes() }})</button>

                        @endif
                    @endauth
                </div>
                @if (isset($edit_comment_id) && $edit_comment_id == $item->id)
                <form wire:submit.prevent="store" class="my-3">
                    <div class="mb-3">
                        <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror" placeholder="Tulis balasan"></textarea>
                        @error('body2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Balas</button>
                    </div>
                </form>
                @endif
                @if (isset($edit_comment_id) && $edit_comment_id == $item->id)
                <form wire:submit.prevent="change" class="my-3">
                    <div class="mb-3">
                        <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror" placeholder="Tulis komentar"></textarea>
                        @error('body2') <!-- FIXED: changed to 'body2' -->
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
        @if ($item->childrens)
            @foreach ($item->childrens as $item2)
            <div class="d-flex align-items-start ms-4">
                <img src="" alt="users" width="30px">
                <div>
                    <div>
                        <span>{{ $item2->user->name }}</span>
                        <span>{{ $item2->created_at }}</span>
                    </div>
                    <div class="text-secondary mb-2"> <!-- FIXED: corrected "tect-secondary" to "text-secondary" -->
                        {{ $item2->body }}
                    </div>
                    <div>
                        @auth
                        <button class="btn btn-sm btn-primary" wire:click="selectReply({{ $item2->id }})">Balas</button>
                        @if ($item2->user_id == Auth::user()->id)
                        <button class="btn btn-sm btn-warning" wire:click="selectEdit({{ $item2->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $item2->id }})">Hapus</button>
                        @endif
                        @if ($item->hasLike)
                        <button wire:click="like({{
                        $item->id }})" class="btn btn-sm btn-danger"><i class="bi bi-heart-fill"></i>({{ $item->totalLikes() }})</button>
                        @else
                        <button wire:click="like({{
                        $item->id }})" class="btn btn-sm btn-dark"><i class="bi bi-heart-fill"></i>({{ $item->totalLikes() }})</button>

                        @endif
                        @endauth
                    </div>
                </div> <!-- FIXED: added missing closing tag for div -->
                @if (isset($edit_comment_id) && $edit_comment_id == $item2->id)
            </div>
                <form wire:submit.prevent="store" class="my-3 ms-4">
                    <div class="mb-3">
                        <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror" placeholder="Tulis balasan"></textarea>
                        @error('body2') <!-- FIXED: changed to 'body2' -->
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Balas</button>
                    </div>
                </form>
                @endif
                @if (isset($edit_comment_id) && $edit_comment_id == $item2->id)
                <form wire:submit.prevent="change" class="my-3 ms-4">
                    <div class="mb-3">
                        <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror" placeholder="Tulis komentar"></textarea>
                        @error('body2') <!-- FIXED: changed to 'body2' -->
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                @endif
            </div>
            @endforeach
        @endif
    </div>
    @endforeach
</div> <!-- FIXED: added closing div for the main container -->
