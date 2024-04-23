

@extends('layouts.frontend')
<div  id="confetti-wrapper"></div>
<style>
    #confetti-wrapper {
        top:0;
        left:0;
  position: absolute;
  overflow: hidden;
  width: 100%;
  height: 100vh;
}

.confetti {
  position: absolute;
  width: 10px;
  height: 10px;
  opacity: 0.7;
  background-color: #ff0;
  animation: fall linear forwards;
}

@keyframes fall {
  to {
    transform: translateY(100vh);
    opacity: 0;
  }
}

</style>
@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="py-5"  style="background:transparent!important;">
               

                <div class="card-body  justify-content-center" style="background:transparent!important;">
                   <h1 class="text-center">Congratulations {{$user}}!</h1>
                   <p class="text-center">You just received {{$points}} points.</p>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
const wrapper = document.getElementById('confetti-wrapper');

for (let i = 0; i < 1000; i++) {
  const confetti = document.createElement('div');
  confetti.className = 'confetti';
  confetti.style.left = `${Math.random() * 100}%`;
  confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 50%)`;
  confetti.style.opacity = Math.random();
  confetti.style.transform = `scale(${Math.random()})`;
  confetti.style.animationDuration = `${Math.random() * 3 + 2}s`;
  confetti.style.animationDelay = `${Math.random() * 5}s`;

  wrapper.appendChild(confetti);
}
    </script>
@endsection