<x-main-layout title="Plans">
    @push('styles')
        <style>
            .btn-outline-mycolor{
                border:2px solid #456991; 
                color: #456991;
            }
            .btn-outline-mycolor:hover{
                background:#456991; 
                color: white;
            }
            .text-bg-mycolor{
                color: white;
                background: #456991;
            }
            .border-mycolor{
                border: 1px solid #456991;
            }
        </style>

        <div class="container py-3">
            <div class="text-center my-5">
                <h1 class="text-white">You’ve got the ideas,we’ve got the plans</h1>
                <p style="color: #bec5cc;">Whether you’re sending big files for fun or delivering work for clients—keep creative  <br>  projects moving forward with WeTransfer.</p>
            </div>
            <div class="row row-cols-1 row-cols-md-3 mb-3">
                @foreach ($plans as $plan)
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-lg @if ($plan->featured) border-mycolor @endif">
                            <div
                                class="card-header py-3 @if ($plan->featured) text-bg-mycolor  @endif">
                                <h4 class="my-0 fw-normal">{{ $plan->name }}</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">${{ $plan->price }}<small
                                        class="text-body-secondary fw-light">/mo</small></h1>
                                <ul class="list-unstyled mt-3 mb-4 text-start">
                                    @foreach ($plan->features as $feature)
                                        <li><i class="fa-solid fa-check me-3"></i>{{ $feature->name }}</li>
                                    @endforeach
                                </ul>
                                <form action="{{ route('subscriptions.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                    <input type="hidden" name="period" value="3">
                                    <button type="submit" class="w-100 btn btn-lg btn-outline-mycolor">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </x-main-layout>
