import { getFetchClient } from '$lib/js/backendFetchClient';
import { error } from '@sveltejs/kit';
import type { PageServerLoad } from './$types';

export const load: PageServerLoad = async (event) => {
	const fetchClient = getFetchClient(event);
	const {
		data,
		error: fetchError,
		response
	} = await fetchClient.GET('/todo/{todo}', {
		params: {
			path: {
				todo: event.params.todoId
			}
		}
	});

	if (response.status === 404) throw error(404);
	if (data === undefined) throw error(response.status, fetchError);
	return { todo: data };
};
