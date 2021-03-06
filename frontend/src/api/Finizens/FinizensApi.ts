import FetchHttpClient from "@/api/FetchHttpClient";

export default class FinizensApi {

    constructor(
        protected apiUrl: string = process.env.VUE_APP_API_URL,
        protected readonly httpClient = new FetchHttpClient()
    ) {
    }
}