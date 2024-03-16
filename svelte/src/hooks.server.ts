import { env } from '$env/dynamic/public';
import { axiosBackend } from '$lib/js/axiosBackend';
import type { paths } from '$lib/js/openApiSchema';
import { redirect, type Handle } from '@sveltejs/kit';
import createClient from 'openapi-fetch';

export const handle: Handle = async ({ event, resolve }) => {
	const headers = {
		Accept: 'application/json',
		'Content-Type': 'application/json',
		Referer: event.url.host,
		'X-XSRF-TOKEN': event.cookies.get('XSRF-TOKEN'),
		Cookie: `XSRF-TOKEN=${event.cookies.get('XSRF-TOKEN')};laravel_session=${event.cookies.get(
			'laravel_session'
		)}`
	};
	console.log({ headers });
	const routeId = event.route.id ?? '';
	const client = createClient<paths>({
		baseUrl: env.PUBLIC_API_URL,
		fetch: fetch,
		credentials: 'include',
		headers
	});
	// Verify we are authenticated
	const { data, error } = await client.GET('/user');

	if (data === undefined && routeId.includes('/(auth)/')) {
		// Need authentication
		throw redirect(303, '/login');
	}
	event.locals.user = data ?? null;

	const newTheme = event.url.searchParams.get('theme');
	const cookieTheme = event.cookies.get('theme');
	const theme = newTheme ?? cookieTheme;

	return await resolve(event, {
		transformPageChunk: ({ html }) => html.replace('theme=""', `theme="${theme}"`)
	});
};
