import FinizensApi from "@/api/Finizens/FinizensApi";
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

    public all(): Promise<Portfolio[]> {
        return Promise.resolve([
           new Portfolio(1,[new Allocation(1,5),new Allocation(2,21)]),
           new Portfolio(2,[new Allocation(4,1),new Allocation(6,9)]),
           new Portfolio(3,[new Allocation(22,30),new Allocation(65,23)]),
        ]);

        // return this.httpClient
        //     .get<portfolioResponse[]>(`${this.apiUrl}/portfolio`)
        //     .then((response: portfolioResponse[]) => {
        //         return response.map((portfolio: portfolioResponse) => {
        //             return this.cast(portfolio);
        //         })
        //     });
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