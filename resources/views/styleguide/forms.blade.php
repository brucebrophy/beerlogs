@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<div class="col-12 md:col-8 md:offset-2">
				<div class="rounded-lg shadow-lg bg-white">
					<div class="p-8">
						<label class="mb-5 font-mono text-indigo-600 block uppercase">
							Name
							<input class="form-input text-gray-700 w-full border mt-2 focus:border-indigo-600 " type="text" placeholder="Jelly King">
						</label>
						<label class="mb-5 font-mono text-indigo-600 block uppercase">
							Style
							<select class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option disabled selected>Select...</option>
								@foreach (\App\Models\Beers\Style::orderBy('name')->get() as $style)								
									<option value="">{{ $style->name }}</option>
								@endforeach
							</select>
						</label>
						<label class="mb-5 font-mono text-indigo-600 block uppercase">
							Notes
							<input class="form-input text-gray-700 w-full border mt-2 focus:border-indigo-600 " type="text" placeholder="An everyday, juicy, drinkable sour with punchy hop aromatics and fruity foundational flavours.">
						</label>
						<label class="mb-5 font-mono text-indigo-600 block uppercase">
							Description
							<textarea class="form-input text-gray-700 w-full border mt-2 focus:border-indigo-600" rows="7" placeholder="Rather than choosing between sour or hoppy, we decided to create a beer that would be both at the same time. Showcasing the aromatic benefits of a generous dry hop (Citra, Amarillo, and Cascade), harnessing the pleasing acidity of lactic acid producing bacteria (we use a house blend), and coming to a bottle near you without a pesky 2 year slumber in oak, Jelly King is the fermented embodiment of having your cake and eating it too."></textarea>
						</label>
						<div class="flex justify-end">
							<button class="px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Continue to Recipe -></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
