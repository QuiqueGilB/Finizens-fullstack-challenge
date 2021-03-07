export default interface HttpClient {

    get<T>(
        url: string,
        headers: {} | null,
        query: { [key: string]: string | number } | null,
    ): Promise<T>;


    post<T>(
        url: string,
        headers: { [key: string]: string } | null,
        body: {} | null
    ): Promise<T>


    put<T>(
        url: string,
        headers: { [key: string]: string } | null,
        body: {} | null
    ): Promise<T>
}