import FinizensApi, {apiCollection} from "@/api/Finizens/FinizensApi";
import Portfolio from "@/model/Portfolio/Portfolio";
import Allocation from "@/model/Portfolio/Allocation";


type allocationResponse = {
    id: number;
    shares: number;
};

type portfolioResponse = {
    id: number;
    allocations: allocationResponse[];
};

export default class PortfolioClient extends FinizensApi {

    public byId(portfolioId: number): Promise<portfolioResponse> {
        return this.httpClient
            .get<portfolioResponse>(`${this.apiUrl}/portfolio/${portfolioId}`)
            .then((response: portfolioResponse) => {
                return this.cast(response);
            });
    }

    public search(): Promise<apiCollection<Portfolio[]>> {
        return this.httpClient
            .get<apiCollection<portfolioResponse[]>>(
                `${this.apiUrl}/portfolio`
            )
            .then(response => {
                return {
                    data: response.data.map((portfolio: portfolioResponse) => {
                        return this.cast(portfolio);
                    }),
                    meta: response.meta
                }
            });
    }

    public save(portfolio: Portfolio): Promise<void> {
        return this.httpClient.put(`${this.apiUrl}/portfolio`, {}, portfolio);
    }

    private cast(response: portfolioResponse): Portfolio {
        return new Portfolio(
            response.id,
            response.allocations.map((allocation: allocationResponse) => {
                return new Allocation(allocation.id, allocation.shares);
            })
        )
    }
}