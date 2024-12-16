@extends('admin.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid px-4 rounded shadow" style="background-color: #e5e9ee;">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">

        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Danh mục ({{ $numberOfCategories }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('category.all') }}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Môn học ({{ $numberOfQuizzes }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('quiz.all') }}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Câu hỏi ({{ $numberOfQuestions }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('question.all') }}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Người dùng ({{ $numberOfUsers }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('user.all') }}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
        Charts
        <div class="row justify-content-around">
            <div style="width: 18rem;">
                <canvas id="doughnutChart"></canvas>
            </div>
            <div style="width: 18rem;">
                <select name="quiz_id" id="quiz" class="form-select">
                    <option value="">Chọn môn học</option>
                    @foreach ($quizzes as $quiz)
                        <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                    @endforeach
                </select>
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
<script>
    const doughnutChart = $('#doughnutChart')
    const barChart = $('#barChart')
    const userPointsDistinct = {!! $userPointsDistinct !!}
    const userPointsData = {!! $userPoints !!}

    let userPoints = userPointsDistinct.map((item) => {
            let count = 0
            userPointsData.forEach(el => {
                if (el.points == item.points) {
                    count++;
                }
            });
            return count;
        });

    new Chart(doughnutChart, {
        type: 'doughnut',
        data: {
            labels: ['Môn học', 'Câu hỏi', 'Danh mục', 'Người dùng'],
            datasets: [{
                data: [{{ $numberOfQuizzes }}, {{ $numberOfQuestions }}, {{ $numberOfCategories }}, {{ $numberOfUsers }}],
                backgroundColor: [
                    'rgb(13, 110, 253)',
                    'rgb(255, 193, 7)',
                    'rgb(77, 164, 112)',
                    'rgb(220, 53, 69)'
                ],
                hoverOffset: 4,
                borderWidth: 0.5
            }],
        },
    });

    const chart = new Chart(barChart, {
        type: 'bar',
        data: {
            labels: userPointsDistinct.map((item) => `Điểm ${item.points}`),
            datasets: [{
                label: 'Số lượng',
                data: userPoints,
                hoverOffset: 4,
                borderWidth: 0.5
            }],
        },
        // Chỗ này để cho giá trị cột y là số nguyên
        options: {
            scales: {
                y: {
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    $('#quiz').change(function (event) {
        $.ajax({
            url: "{{ route('admin.dashboard') }}",
            data: {
                'quiz_id': Number($(this).val()),
            },
            success: function (data) {
                // console.log(data);
                userPoints = data.userPointsDistinct.map((item) => {
                    let count = 0
                    data.userPointsData.forEach(el => {
                        if (el.points == item.points) {
                            count++;
                        }
                    });
                    return count;
                });

                // console.log(userPoints)

                chart.data.labels = data.userPointsDistinct.map((item) => `Điểm ${item.points}`);
                chart.data.datasets.forEach((dataset) => {
                    dataset.data = userPoints
                });

                chart.update();
            }
        })
    })


</script>
@endpush
