import { axiosBackend } from '$lib/js/axiosBackend';
import { redirect, type Handle } from '@sveltejs/kit';

export const handle: Handle = async ({ event, resolve }) => {
	// Verify we are authenticated
	const responseFromServer = await axiosBackend('/api/user', {
		method: 'get',
		headers: {
			Referer: event.url.host,
			'X-XSRF-TOKEN': event.cookies.get('XSRF-TOKEN'),
			Cookie: `XSRF-TOKEN=${event.cookies.get('XSRF-TOKEN')};laravel_session=${event.cookies.get(
				'laravel_session'
			)}`
		}
	}).catch((e) => {
		console.error(e);
		// Unauthenticated
	});
	//   console.log(responseFromServer);

	event.locals.user = responseFromServer?.data ?? null;
	const routeId = event.route.id ?? '';

	if (!event.locals.user && routeId.includes('/(auth)/')) {
		// Need authentication
		throw redirect(303, '/login');
	}

    let theme: string | null | undefined = null;

	const newTheme = event.url.searchParams.get('theme');
	const cookieTheme = event.cookies.get('theme');
	if (newTheme) {
		theme = newTheme;
	} else {
		theme = cookieTheme;
	}

	return await resolve(event, {
		transformPageChunk: ({ html }) => html.replace('theme=""', `theme="${theme}"`),
	});
};
