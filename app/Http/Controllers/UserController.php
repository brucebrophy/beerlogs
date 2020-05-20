<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		$user->load([
			'beers',
			'beers.recipes',
		]);

		return view('users.show', [
			'user' => $user,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		$this->authorize('update', $user);
		return view('users.edit', [
			'user' => $user
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateUser $request, User $user)
	{
		$this->authorize('update', $user);
		$user->fill($request->only(['email', 'name']));
		$user->save();
		return redirect()->route('users.edit', $user->username);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, User $user)
	{
		$this->authorize('delete', $user);

		$request->validate([
			'confirm_email' => 'required'
		]);

		if ($request->input('confirm_email') !== $user->email) {
			return redirect()
				->route('users.edit', $user->username)
				->with('error', 'The typed email does not match.');
		}

		$user->delete();
		return redirect()->route('home');
	}
}
