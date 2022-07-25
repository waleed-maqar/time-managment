<h6 class="badge {{ $step->done ? 'step-done badge-success' : '' }}"
    id="single-step-{{ $step->id }} task-single-step">
    {{ $step->step }} ---> <b>{{ $step->id }}</b>
</h6>
