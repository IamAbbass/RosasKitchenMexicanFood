@if ($errors->any())
<div class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-warning"><i class='bx bx-info-circle'></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-warning">Warning</h6>
            @foreach ($errors->all() as $index => $error)
                <div>{{ $index+1 }}. {{ $error }}</div>
                @endforeach
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('success'))
<div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-0">
    <div class="d-flex align-items-center">
        <div class="font-35 text-success"><i class='bx bxs-check-circle'></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-success">Success</h6>
            <div>{{ session('success') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-0">
    <div class="d-flex align-items-center">
        <div class="font-35 text-danger"><i class='bx bxs-message-square-x'></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-danger">Error</h6>
            <div>{{ session('error') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('warning'))
<div class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-0">
    <div class="d-flex align-items-center">
        <div class="font-35 text-warning"><i class='bx bx-info-circle'></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-warning">Warning</h6>
            <div>{{ session('warning') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('info'))
<div class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-0">
    <div class="d-flex align-items-center">
        <div class="font-35 text-info"><i class='bx bx-info-square'></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-info">Info</h6>
            <div>{{ session('info') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



