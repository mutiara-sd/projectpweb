@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <div class="bg-white p-6 rounded shadow mb-6">
        <h3 class="text-lg font-semibold mb-3">Grafik Donasi dan Penerima Donasi</h3>
        <canvas id="myChart" height="100"></canvas>
        <button id="downloadPdf" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Download PDF
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        const ctx = document.getElementById("myChart").getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Donasi', 'Penerima Donasi'],
                datasets: [{
                    label: 'Jumlah Orang',
                    data: [{{ $jumlah_donasi }}, {{ $jumlah_penerima }}],
                    backgroundColor: ['#60a5fa', '#facc15'],
                    borderColor: ['#3b82f6', '#eab308'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });

        document.getElementById('downloadPdf').addEventListener('click', () => {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            const canvas = document.getElementById("myChart");
            const imgData = canvas.toDataURL("image/png");
            pdf.text("Grafik Donasi dan Penerima Donasi", 15, 20);
            pdf.addImage(imgData, "PNG", 15, 30, 180, 100);
            pdf.save("chart.pdf");
        });
    </script>
@endsection
