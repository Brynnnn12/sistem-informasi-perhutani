<div x-data="{ count: 0, target: {{ $target }} }" x-init="let duration = 2000;
let frame = 0;
let totalFrames = Math.round(duration / 16);
let start = 0;
let end = target;

function easeOutQuad(t) { return t * (2 - t); }

function animateCount() {
    frame++;
    let progress = frame / totalFrames;
    let current = Math.round(start + (end - start) * easeOutQuad(progress));
    if (current > end) current = end;
    count = current;
    if (frame < totalFrames) {
        requestAnimationFrame(animateCount);
    } else {
        count = end;
    }
}
animateCount();" x-text="count" {{ $attributes }}></div>
