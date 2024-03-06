import createClient from 'openapi-fetch';
import type { paths } from './openApiSchema';
import { env } from '$env/dynamic/public';

export const getFetchClient = (fetcher: typeof fetch) => {
	// TODO: add csrf token here
	return createClient<paths>({
		baseUrl: env.PUBLIC_API_URL,
		fetch: fetcher
	});
};
