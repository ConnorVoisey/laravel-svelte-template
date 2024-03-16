import { getFetchClient } from '$lib/js/backendFetchClient';
import { error } from '@sveltejs/kit';
import type { LayoutServerLoad } from './$types';

export const load: LayoutServerLoad = async (event) => {
	const client = getFetchClient(event);

	const { data, error: fetchError } = await client.GET('/todo');
	if (data === undefined) throw error(500, fetchError);
	return {
		todos: data
	};
};
