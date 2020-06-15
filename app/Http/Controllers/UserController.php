<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{
	/**
	 * @param  User  $user
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(User $user)
	{
		$user->load([
			'beers',
			'beers.recipes',
            'comments',
		]);

		return view('users.show', [
			'user' => $user,
		]);
	}

	/**
	 * @param  User  $user
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function edit(User $user)
	{
		$this->authorize('update', $user);
		return view('users.edit', [
			'user' => $user
		]);
	}

	/**
	 * @param  UpdateUser  $request
	 * @param  User  $user
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function update(UpdateUser $request, User $user)
	{
		$this->authorize('update', $user);
		$user->fill($request->only(['email', 'name']));
		$user->save();
		return redirect()->route('users.edit', $user->username);
	}

	/**
	 * @param  Request  $request
	 * @param  User  $user
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
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
