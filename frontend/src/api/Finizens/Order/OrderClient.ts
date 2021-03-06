import FinizensApi, {QueryParams} from "@/api/Finizens/FinizensApi";
import Order from "@/model/Order/Order";
import OrderType from "@/model/Order/OrderType";
import OrderStatus from "@/model/Order/OrderStatus";

type orderResponse = {
    id: number;
    portfolio: number;
    allocation: number;
    shares: number;
    orderType: string;
    orderStatus: string;
};

export default class OrderClient extends FinizensApi {

    create(order: Order): Promise<void> {
        return this.httpClient
            .post(
                `${this.apiUrl}/${order.orderType.isBuy() ? 'buy' : 'sell'}`,
                null,
                {
                    id: order.id,
                    portfolio: order.portfolioId,
                    allocation: order.allocationId,
                    shares: order.shares
                }
            );
    }

    search(query: QueryParams): Promise<Order[]> {
        return this.httpClient
            .get<orderResponse[]>(
                `${this.apiUrl}/orders`,
                null,
                query
            ).then((response: orderResponse[]) => {
                return response.map((orderResponse: orderResponse) => {
                    return OrderClient.cast(orderResponse);
                })
            });
    }

    private static cast(orderResponse: orderResponse): Order {
        return new Order(
            orderResponse.id,
            orderResponse.portfolio,
            orderResponse.allocation,
            orderResponse.shares,
            new OrderType(orderResponse.orderType),
            new OrderStatus(orderResponse.orderStatus)
        )
    }
}