<div class="row">
	<div class="col-12">
		<div class="rounded-lg mb-6 overflow-hidden border border-gray-200 shadow-md bg-white">
			<div class="py-3 flex justify-center bg-indigo-600">
				<h4 class="font-mono text-white font-bold tracking-wider uppercase">Recipe Details</h4>
			</div>
			<div class="p-6">
				<div class="row">
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('abv', 'ABV', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							<div class="flex mt-2">
								{{ Form::text('abv', $recipe->abv, ['class' => 'form-input w-full font-mono border border-r-0 rounded-r-none focus:border-indigo-600', 'placeholder' => 'ABV']) }}
								<div class="inline-block font-mono border border-l-0 rounded rounded-l-none border-gray-300">
									<span class="inline-block p-3">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('ibu', 'IBU', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::text('ibu', $recipe->ibu, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'IBU']) }}
						</div>
					</div>
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('batch_size', 'Batch Size', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							<div class="flex mt-2">
								{{ Form::text('batch_size', $recipe->batch_size, ['class' => 'form-input w-full font-mono border border-r-0 rounded-r-none focus:border-indigo-600', 'placeholder' => 'Batch Size']) }}
								<div class="inline-block font-mono border border-l-0 rounded rounded-l-none border-gray-300">
									{{ Form::select('unit_id', $units, $recipe->unit_id, ['class' => 'form-select rounded-l-none border-0 w-20']) }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('og', 'OG', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::text('og', $recipe->og, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'OG']) }}
						</div>
					</div>
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('fg', 'FG', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::text('fg', $recipe->fg, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'FG']) }}
						</div>
					</div>
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('srm', 'SRM', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::text('srm', $recipe->srm, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'SRM']) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="lg:col-4">
		<hop-selector-component />
	</div>
	<div class="lg:col-4">
		<malt-selector-component />
	</div>
	<div class="lg:col-4">
		<yeast-selector-component />
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="rounded-lg mt-6 overflow-hidden border border-gray-200 shadow-md bg-white">
			<div class="py-3 flex justify-center bg-indigo-600">
				<h4 class="font-mono text-white font-bold tracking-wider uppercase">Instructions</h4>
			</div>
			{{ Form::textarea('instructions', $recipe->instructions, ['class' => 'form-input font-mono w-full rounded-lg border-0 rounded-t-none focus:border-indigo-600', 'placeholder' => '']) }}
		</div>
	</div>
</div>

{{ Form::hidden('beer_id', $beer->id) }}