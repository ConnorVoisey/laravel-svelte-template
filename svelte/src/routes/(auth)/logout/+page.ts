import type { PageLoad } from './$types';
import { axios } from '$lib/js/axios';
import { goto } from '$app/navigation';

export const ssr = false;

export const load: PageLoad = async () => {
	await axios.post('logout');
	goto('/', { invalidateAll: true });
};
