#include<bits/stdc++.h>
using namespace std;
const long long N=300004;
long long n,m,u,v,c[N],f[N][70],K,ans=0;
vector<long long> a[N];
long long get(long long x,long long i)
{
    return(x>>i)&1;
}
long long cal(long long x,long long bit)
{
    //cout<<x<<" "<<bit<<endl;
    if(f[x][bit]!=-1) return f[x][bit];
    f[x][bit]=1;
    for(long long i=0;i<a[x].size();i++)
    {
        long long col=c[a[x][i]];
        if(!get(bit,col))
        {
            long long nx=(bit|(1<<col));
            f[x][bit]+=cal(a[x][i],nx);
        }
    }
    return f[x][bit];
}
int main()
{
    freopen("COLPATHS.INP","r",stdin);
    freopen("COLPATHS.OUT","w",stdout);
    scanf("%d%d%d",&n,&m,&K);
    for(long long i=1;i<=n;i++)
    {
        scanf("%d",&c[i]);
    }
    for(long long i=1;i<=m;i++)
    {
        scanf("%d%d",&u,&v);
        a[u].push_back(v);
        a[v].push_back(u);
    }
    memset(f,255,sizeof(f));
    for(long long i=1;i<=n;i++)
    {
        ans+=cal(i,(1<<c[i]));
    }
    cout<<ans-n;
}
