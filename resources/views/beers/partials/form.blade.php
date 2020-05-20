<div class="mb-5">
	{{ Form::label('name', 'Name', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
	{{ Form::text('name', $beer->name, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Jelly King']) }}
	@error('name')
		<span class="block mt-2 font-mono text-sm text-red-600">{{ $message }}</span>
	@enderror
</div>
<div class="mb-5">
	{{ Form::label('style_id', 'Notes', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
	{{ Form::select('style_id', $styles, null, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Select...']) }}
	@error('style_id')
		<span class="block mt-2 font-mono text-sm text-red-600">{{ $message }}</span>
	@enderror
</div>
<div class="mb-5">
	{{ Form::label('notes', 'Notes', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
	{{ Form::text('notes', $beer->notes, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Jelly King']) }}
	@error('notes')
		<span class="block mt-2 font-mono text-sm text-red-600">{{ $message }}</span>
	@enderror
</div>
<div class="mb-5">
	{{ Form::label('description', 'Description', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
	{{ Form::textarea('description', $beer->description, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'rows' => '7', 'placeholder' => 'Rather than choosing between sour or hoppy, we decided to create a beer that would be both at the same time. Showcasing the aromatic benefits of a generous dry hop (Citra, Amarillo, and Cascade), harnessing the pleasing acidity of lactic acid producing bacteria (we use a house blend), and coming to a bottle near you without a pesky 2 year slumber in oak, Jelly King is the fermented embodiment of having your cake and eating it too.']) }}
	@error('description')
		<span class="block mt-2 font-mono text-sm text-red-600">{{ $message }}</span>
	@enderror
</div>