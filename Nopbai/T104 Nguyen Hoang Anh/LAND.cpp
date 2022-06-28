#include<bits/stdc++.h>
using namespace std;
const int N=304;
int m,n,K,a[N][N],mn[N],mx[N],vc=1000000000,ans=0;
deque<int> dmn, dmx;
int main()
{
    freopen("LAND.INP","r",stdin);
    freopen("LAND.OUT","w",stdout);
    cin>>m>>n>>K;
    for(int i=1;i<=m;i++)
    {
        for(int j=1;j<=n;j++)
        {
            cin>>a[i][j];
        }
    }
    for(int l=1;l<=n;l++)
    {
        for(int i=1;i<=m;i++) mn[i]=vc,mx[i]=-vc;
        for(int r=l;r<=n;r++)
        {
            while(!dmn.empty()) dmn.pop_back();
            while(!dmx.empty()) dmx.pop_back();
            int up=1;
            for(int i=1;i<=m;i++)
            {
                mn[i]=min(mn[i],a[i][r]);
                mx[i]=max(mx[i],a[i][r]);
                while(!dmn.empty()&&mn[dmn.back()]>=mn[i]) dmn.pop_back();
                while(!dmx.empty()&&mx[dmx.back()]<=mx[i]) dmx.pop_back();
                dmn.push_back(i);
                dmx.push_back(i);
                while(!dmn.empty()&&!dmx.empty()&&mx[dmx.front()]-mn[dmn.front()]>K)
                {
                    up++;
                    while(!dmn.empty()&&dmn.front()<up) dmn.pop_front();
                    while(!dmx.empty()&&dmx.front()<up) dmx.pop_back();
                }
                if(up<=i) ans=max(ans,(r-l+1)*(i-up+1));
            }
        }
    }
    cout<<ans;
}
