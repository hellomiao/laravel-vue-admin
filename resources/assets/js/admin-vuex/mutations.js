/**
 * Created by yangchunrun on 17/3/2.
 */
export const websocket = (state) => {
    var wsServer = 'ws://127.0.0.1:9501?uid='+window.User.id;
    //调用websocket对象建立连接：
    //参数：ws/wss(加密)：//ip:port （字符串）
    var websocket = new WebSocket(wsServer);
    return state.websocket  = websocket;
}