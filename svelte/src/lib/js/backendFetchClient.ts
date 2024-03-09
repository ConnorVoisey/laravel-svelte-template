import createClient from 'openapi-fetch';
import type { paths } from './openApiSchema';
import { env } from '$env/dynamic/public';
import type { RequestEvent } from '@sveltejs/kit';

export type FetchClient = ReturnType<typeof createClient<paths>>;

type SvelteKitEvent = RequestEvent<Partial<Record<string, string>>, string | null>;
export const getFetchClient = (event: SvelteKitEvent) =>
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
