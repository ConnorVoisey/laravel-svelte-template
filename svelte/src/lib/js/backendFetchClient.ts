import createClient from 'openapi-fetch';
import type { paths } from './openApiSchema';
import { env } from '$env/dynamic/public';
import type { Cookies, RequestEvent } from '@sveltejs/kit';

export type FetchClient = ReturnType<typeof createClient<paths>>;

export const getFetchClient = (event: { fetch: typeof fetch; url: URL; cookies: Cookies }) =>
	createClient<paths>({
		baseUrl: env.PUBLIC_API_URL,
		fetch: event.fetch,
		credentials: 'include',
		headers: {
			Accept: 'application/json',
			'Content-Type': 'application/json',
			Referer: event.url.host,
			'X-XSRF-TOKEN': event.cookies.get('XSRF-TOKEN'),
			Cookie: `XSRF-TOKEN=${event.cookies.get('XSRF-TOKEN')};laravel_session=${event.cookies.get(
				'laravel_session'
			)}`
		}
	});
