<div class="row">
	<div class="col-12">
		<div class="rounded-lg mb-6 overflow-hidden border border-gray-200 shadow-md bg-white">
			<div class="p-6">
				<div class="row">
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('abv', 'ABV', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('abv', $recipe->abv, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'ABV']) }}
						</div>
					</div>
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('ibu', 'IBU', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('ibu', $recipe->ibu, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'IBU']) }}
						</div>
					</div>
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('batch_size', 'Batch Size', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('batch_size', $recipe->batch_size, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Batch Size']) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('og', 'OG', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('og', $recipe->og, ['step' => '0.01', 'class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'OG']) }}
						</div>
					</div>
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('fg', 'FG', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('fg', $recipe->og, ['step' => '0.01', 'class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'FG']) }}
						</div>
					</div>
					<div class="col-4">
						<div class="mb-2 font-mono block">
							{{ Form::label('srm', 'SRM', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('srm', $recipe->srm, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'SRM']) }}
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
</div>

{{ Form::hidden('beer_id', $beer->id) }}