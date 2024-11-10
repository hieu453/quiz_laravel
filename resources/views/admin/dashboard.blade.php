@extends('admin.app')
@section('content')
    <div class="container-fluid px-4 rounded shadow" style="background-color: #e5e9ee;">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">

        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Quizzes ({{ $numberOfQuizzes }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('quiz.all') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Questions ({{ $numberOfQuestions }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('question.all') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
        Charts
        <div style="width: 18rem;">
            <canvas id="chartStatistics"></canvas>
        </div>
    </div>
@endsection
@push('javascript')
<script>
    const ctx = $('#chartStatistics')

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Quizzes', 'Questions', 'Categories'],
            datasets: [{
                label: 'Dataset',
                data: [{{ $numberOfQuizzes }}, {{ $numberOfQuestions }}, {{ $numberOfCategories }}],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(77, 164, 112)'
                ],
                hoverOffset: 4,
                borderWidth: 0.5
            }],
        },
    });
</script>
@endpush
