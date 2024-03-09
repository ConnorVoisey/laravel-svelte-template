import { getFetchClient } from '$lib/js/backendFetchClient';
import type { LayoutServerLoad } from './$types';

export const load: LayoutServerLoad = async (event) => {
	const client = getFetchClient(event);

	const { data, error } = await client.GET('/todo');
	return {
		user: event.locals.user,
		data,
		error
	};
};
