import FetchHttpClient from "@/api/FetchHttpClient";

export type QueryParams = {
    filters: string;
    order: string;
    offset: number;
    limit: number;
}

export default class FinizensApi {

    constructor(
        protected apiUrl: string = process.env.VUE_APP_API_URL,
        protected readonly httpClient = new FetchHttpClient()
    ) {
    }
}