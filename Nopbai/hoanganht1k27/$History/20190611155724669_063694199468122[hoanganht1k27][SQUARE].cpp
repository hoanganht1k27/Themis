#include<bits/stdc++.h>
#define ii pair<int,int>
#define X first
#define Y second
using namespace std;
const int N=100004,vc=1000000009;
int n,u,v,X1,X2,Y1,Y2,r1x,r1y,r2x,r2y,test;
vector<ii> vt;
int main()
{
    freopen("SQUARE.INP","r",stdin);
    freopen("SQUARE.OUT","w",stdout);
    cin>>test;
    while(test--)
    {
        vt.clear();
        X1=Y1=vc;
        X2=Y2=-vc;
        r1x=r1y=-vc;
        r2x=r2y=vc;
        scanf("%d",&n);
        for(int i=1;i<=n;i++)
        {
            scanf("%d%d",&u,&v);
            vt.push_back(ii(u,v));
            X1=min(X1,u);
            Y1=min(Y1,v);
            X2=max(X2,u);
            Y2=max(Y2,v);
        }
        for(int i=0;i<vt.size();i++)
        {
            u=vt[i].X,v=vt[i].Y;
            int k1=max(u-X1,v-Y1);
            int k2=max(X2-u,Y2-v);
            if(k1>k2){
                r2x=min(r2x,u);
                r2y=min(r2y,v);
            }
            else{
                r1x=max(r1x,u);
                r1y=max(r1y,v);
            }
        }
        cout<<max(max(X2-r2x,Y2-r2y),max(r1x-X1,r1y-Y1))<<endl;
    }
}
