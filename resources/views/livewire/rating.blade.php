<div>
    <div class="row mt-3 py-3 rounded bg-body-secondary">
    @if (Auth::check())
        <div class="col-6">
            <h1>Đánh giá</h1>
            <hr>
            <ul class="rounded" style="list-style-type: none;">
                <li wire:click="rate(5, {{ $quizId }})" class="px-2 py-2 {{ $activeNumber == 5 ? 'border border-danger' : ''}}" style="cursor: pointer">
                    <span style="font-size: 20px;">5</span>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </li>
                <li wire:click="rate(4, {{ $quizId }})" class="px-2 py-2 {{ $activeNumber == 4 ? 'border border-danger' : ''}}" style="cursor: pointer">
                    <span style="font-size: 20px;">4</span>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </li>
                <li wire:click="rate(3, {{ $quizId }})" class="px-2 py-2 {{ $activeNumber == 3 ? 'border border-danger' : ''}}" style="cursor: pointer">
                    <span style="font-size: 20px;">3</span>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </li>
                <li wire:click="rate(2, {{ $quizId }})" class="px-2 py-2 {{ $activeNumber == 2 ? 'border border-danger' : ''}}" style="cursor: pointer">
                    <span style="font-size: 20px;">2</span>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </li>
                <li wire:click="rate(1, {{ $quizId }})" class="px-2 py-2 {{ $activeNumber == 1 ? 'border border-danger' : ''}}" style="cursor: pointer">
                    <span style="font-size: 20px;">1</span>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </li>
            </ul>
        </div>
        <div class="col-6 text-end align-self-center">
            <span style="font-size: 34px;">{{ $avgStar }} / 5</span>
            <i style="font-size: 34px;" class="fa-solid fa-star"></i>
            <p>Có {{ $ratedCount }} lượt đánh giá</p>
        </div>
    @else
        <div class="col-6">
            <h3>Đăng nhập để đánh giá</h3>
        </div>
        <div class="col-6 text-end align-self-center">
            <span style="font-size: 34px;">{{ $avgStar }} / 5</span>
            <i style="font-size: 34px;" class="fa-solid fa-star"></i>
            <p>Có {{ $ratedCount }} lượt đánh giá</p>
        </div>
    @endif
</div>

@script
<script>
    $wire.on('updated-rating', (e) => {
        Toastify({
            text: `Bạn đã cập nhật lại đánh giá với ${e.star} sao!`,
            close: true,
            duration: 2000
        }).showToast();
    });

    $wire.on('rated', (e) => {
        Toastify({
            text: `Bạn đã đánh giá bài với ${e.star} sao!`,
            close: true,
            duration: 2000
        }).showToast();
    })
</script>
@endscript

