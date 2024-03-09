import createClient from 'openapi-fetch';
import type { paths } from './openApiSchema';
import { env } from '$env/dynamic/public';
import { browser } from '$app/environment';

const getCookie = (name: string) => {
	if (!browser) return undefined;
	return decodeURIComponent(
		document.cookie
			.split(';')
			.map((cookie) => cookie.split('=', 2))
			.find((cookieKV) => cookieKV[0].trim() === name)?.[1] ?? ''
	);
};

export const fetchClient = createClient<paths>({
	baseUrl: env.PUBLIC_API_URL,
	credentials: 'include',
	headers: {
		Accept: 'application/json',
		'Content-Type': 'application/json'
	}
});

fetchClient.use({
	onRequest: async (req) => {
		if (req.method === 'get' || req.method === 'GET') return req;

		let csrfToken = getCookie('XSRF-TOKEN');
		if (!csrfToken) {
			console.log('fetching csrf cookie');
			await fetchClient.GET('/sanctum/csrf-cookie');
			csrfToken = getCookie('XSRF-TOKEN');
		}
		console.log({ csrfToken });
		req.headers.set('X-XSRF-TOKEN', csrfToken ?? '');
		req.headers.set('test', 'testing vlu');
		return req;
	}
});
